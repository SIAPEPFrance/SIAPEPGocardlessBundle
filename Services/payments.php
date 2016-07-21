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

class Payments
{

    public function __construct(EntityManager $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
        $this->access_token = $this->container->getParameter('siapep_gocardless_bundle')['token'];
        $this->url = $this->container->getParameter('siapep_gocardless_bundle')['baseUrl'].'/payments';
        $this->gocardless_version = $this->container->getParameter('siapep_gocardless_bundle')['gocardlessVersion']; 
    }

    public function create($data)
    {
        /*
          Example data :
          array(
                'amount' => $data['amount'],
                'charge_date' => $data['charge_date'],
                'currency' => $data['currency'],
                'description' => $data['description'],
                'reference' => $data['reference'], -> You must provide your own Reference Number (unique)
                'currency' => $data['currency'],
                'metadata'=> $data['metadata'],
                'links'=> array('mandate' =>'ID OF MANDATE AGAINST WICH THIS PAYMENT SHOULD BE COLLECTED',
                                 'creditor' => 'optionnal if you have only one creditor')
              )
        */

        //fields
        $fields = array(
              'payments' => $data
        );

        return $this->GoCardlessConnect($fields);
    }

    /*fields or cursors = after/before/created_at[gt]/created_at[gte]/created_at[lt]/created_at[lte]/creditor/customer/limit/mandate/status/subscription*/
    public function lists($fields=array())
    {
       /*
          status have on of theses values :
           -> pending_customer_approval: we're waiting for the customer to approve this payment
           -> pending_submission: the payment has been created, but not yet submitted to the banks
           -> submitted: the payment has been submitted to the banks
           -> confirmed: the payment has been confirmed as collected
           -> paid_out: the payment has been included in a payout
           -> cancelled: the payment has been cancelled
           -> customer_approval_denied: the customer has denied approval for the payment. You should contact the customer directly
       */
        return $this->GoCardlessConnect($fields, 'GET');
    }

    public function show($paymentId)
    {
        
        //set POST variables
        $fields = array();

        $this->url = $this->url.'/'.$paymentId;

        return $this->GoCardlessConnect($fields, 'GET');
    }

    public function update($paymentId,$data=array())
    {
        /*
          Example data :
          array(
                'metadata'=>$data['metadata'] array 3 items max
              ) only metadata can be updated
        */

        //fields
        $fields = array(
              'payments' => $data
        );

        $this->url = $this->url.'/'.$paymentId;

        return $this->GoCardlessConnect($fields, 'PUT');
    }

    public function cancel($paymentId,$data=array())
    {
        /*
          Example data :
          array(
                'metadata'=>$data['metadata'] array 3 items max
              ) only metadata can be used
        */

        //fields
        $fields = array(
              'payments' => $data
        );

        $this->url = $this->url.'/'.$paymentId.'/actions/cancel';

        return $this->GoCardlessConnect($fields);
    }

    public function retry($paymentId,$data=array())
    {
        /*
          Example data :
          array(
                'metadata'=>$data['metadata'] array 3 items max
              ) only metadata can be used
          payment can be retry only 3 times
        */

        //fields
        $fields = array(
              'payments' => $data
        );

        $this->url = $this->url.'/'.$paymentId.'/actions/retry';

        return $this->GoCardlessConnect($fields);
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
