<?php

namespace SIAPEP\GocardlessBundle\Services;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SIAPEP\GocardlessBundle\Entity\Event;

class events
{

    public function __construct(EntityManager $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
        $this->access_token = $this->container->getParameter('siapep_gocardless_bundle')['token'];
        $this->url = $this->container->getParameter('siapep_gocardless_bundle')['baseUrl'].'/events';
        $this->gocardless_version = $this->container->getParameter('siapep_gocardless_bundle')['gocardlessVersion']; 
    }

    /*fields or cursors = after/before/created_at[gt]/created_at[gte]/created_at[lt]/created_at[lte]/include/limit/mandate/parent_event/payment/payout/refund/resource_type/subscription*/
    public function lists($fields=array())
    {
        return $this->GoCardlessConnect($fields, 'GET');
    }

    public function show($eventId)
    {
        
        //set POST variables
        $fields = array();

        $this->url = $this->url.'/'.$eventId;

        return $this->GoCardlessConnect($fields, 'GET');
    }

    public function webhook($fields,$webhook)
    {
        $entity  = new Event();

        $base_array = array('envent_id' => '', 'action' => '', 'created_at' => '', 'include' => '', 'details_cause' => '', 'details_description' => '', 'details_origin' => '', 'details_reason_code' => '', 'details_scheme' => '', 'links_mandate' => '', 'links_new_customer_bank_account' => '', 'links_organisation' => '', 'links_parent_event' => '', 'links_payment' => '', 'links_payout' => '', 'links_previous_customer_bank_account' => '', 'links_refund' => '', 'links_subscription' => '');

        foreach ($base_array as $key => $item) {
          if(array_key_exists($key,$fields))
          {
              $base_array[$key] = $fields[$key];
          }
        }

        //set POST variables
        $fields = array();
        $entity->setEventIt($fields['envent_id']);
        $entity->setAction($base_array['action']);
        $entity->setCreatedAt($base_array['created_at']);
        $entity->setInclude($base_array['include']);
        $entity->setDetailsCause($base_array['details_cause']);
        $entity->setDetailsDescription($base_array['details_description']);
        $entity->setDetailsOrigin($base_array['details_origin']);
        $entity->setDetailsReasonCode($base_array['details_reason_code']);
        $entity->setDetailsScheme($base_array['details_scheme']);
        $entity->setLinksMandate($base_array['links_mandate']);
        $entity->setLinksNewCustomerBankAccount($base_array['links_new_customer_bank_account']);
        $entity->setLinksOrganisation($base_array['links_organisation']);
        $entity->setLinksParentEvent($base_array['links_parent_event']);
        $entity->setLinksPayment($base_array['links_payment']);
        $entity->setLinksPayout($base_array['links_payout']);
        $entity->setLinksPreviousCustomerBankAccount($base_array['links_previous_customer_bank_account']);
        $entity->setLinksRefund($base_array['links_refund']);
        $entity->setLinksSubscription($base_array['links_subscription']);
        $entity->setImportProcess('webhook');
        $entity->setWebhook($webhook);
        $this->em->persist($entity);
        $this->em->flush();

        
        return new JsonResponse(
            array('status' => 'success',
                  'data' => 
                        array('message' => 'the event has been saved successfully !',
                              'datas_received' => $fields)
            )
        );
    }

    public function GoCardlessConnect($fields, $RequestType='POST')
    {

      $fields_string=$this->encryptData($fields);

      //open connection
      $ch = curl_init();

      //set the url, number of POST vars, POST data
      curl_setopt($ch,CURLOPT_HTTPHEADER,
                array('Authorization: Bearer '.$this->access_token,
                      'GoCardless-Version: '.$this->gocardless_version,
                      'Accept' => 'application/json',
                      'Content-Type: application/json'));
      curl_setopt($ch,CURLOPT_URL, $this->url);

      if($RequestType=='POST')
      {
          curl_setopt($ch,CURLOPT_POST, count($fields));
      }
      else
      {
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $RequestType);
      }

      if($fields_string !='')
      {
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
      }
      curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);


      //execute post
      $result = json_decode(curl_exec($ch), true);

      //close connection
      curl_close($ch);

      //decode $fields_string
      $fields_string = json_decode($fields_string, true);

      if(isset($result['error']))
      {
          return new JsonResponse(
              array('status' => 'failed',
                    'data' => 
                            array('message' => $result,
                                  'datas_sent' => $fields_string)
              )
          );
      }
      else
      {
          return new JsonResponse(
              array('status' => 'success',
                    'data' => 
                          array('message' => $result,
                                'datas_sent' => $fields_string)
              )
          );
      }
    }

    public function encryptData($fields)
    {
      if(count($fields) == 0)
      {
          return '';
      }

      $fields_string='{';
      $i=0;

      //url-ify the data for the POST
      foreach($fields as $key=>$value)
      {
        if(is_array($value))
        {
          if($i==0){$comaI='';}else{$comaI=',';}
          $fields_string.=''.$comaI.'"'.$key.'":{';
          $j=0;
          $i++;

          foreach($value as $sub_key=>$sub_value)
          {
            if(is_array($sub_value))
            {
              if($j==0){$comaJ='';}else{$comaJ=',';}
              $fields_string.=''.$comaJ.'"'.$sub_key.'":{';
              $k=0;
              $j++;

              foreach($sub_value as $sub_sub_key=>$sub_sub_value)
              {
                if(is_array($sub_sub_value))
                {
                  if($k==0){$comaK='';}else{$comaK=',';}
                  $fields_string.=''.$comaK.'"'.$sub_sub_key.'":{';
                  $l=0;
                  $k++;

                  foreach($sub_sub_value as $sub_sub_sub_key=>$sub_sub_sub_value)
                  {
                        if($l==0)
                        {
                            $fields_string .= '"'.$sub_sub_sub_key.'": "'.$sub_sub_sub_value.'"';
                        }
                        else
                        {
                            $fields_string .= ',"'.$sub_sub_sub_key.'": "'.$sub_sub_sub_value.'"';
                        }
                        $l++;
                  }

                  $fields_string.='}';
                }
                else
                {
                    if($k==0)
                    {
                        $fields_string .= '"'.$sub_sub_key.'": "'.$sub_sub_value.'"';
                    }
                    else
                    {
                        $fields_string .= ',"'.$sub_sub_key.'": "'.$sub_sub_value.'"';
                    }

                    $k++;
                }
              }

              $fields_string.='}';
            }
            else
            {
                if($j==0)
                {
                    $fields_string .= '"'.$sub_key.'": "'.$sub_value.'"';
                }
                else
                {
                    $fields_string .= ',"'.$sub_key.'": "'.$sub_value.'"';
                }

                $j++;
            }
          }

          $fields_string.='}';
        }
        else
        {
            if($i==0)
            {
                $fields_string .= '"'.$key.'": "'.$value.'"';
            }
            else
            {
                $fields_string .= ',"'.$key.'": "'.$value.'"';
            }

            $i++;
        }
      }

      $fields_string.='}';

      return $fields_string;
    }
}
