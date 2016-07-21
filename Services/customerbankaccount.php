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

class CustomerBankAccount
{

    public function __construct(EntityManager $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
        $this->access_token = $this->container->getParameter('siapep_gocardless_bundle')['token'];
        $this->url = $this->container->getParameter('siapep_gocardless_bundle')['baseUrl'].'/customer_bank_accounts';
        $this->gocardless_version = $this->container->getParameter('siapep_gocardless_bundle')['gocardlessVersion']; 
    }

    public function create($data)
    {
        /*
          Example data :
          array(
                'account_holder_name' => $data['account_holder_name'],
                'account_number' => $data['account_number'],
                'bank_code' => $data['bank_code'],
                'branch_code'=> $data['branch_code'],
                'country_code'=> $data['country_code'],
                'currency'=> $data['currency'],
                'iban'=> $data['iban'],
                'metadata'=> $data['metadata'],
                'links'=> array('customer' =>'CUSTOMER_ID'
                                'customer_bank_account_token' => '')
              )
        */

        //fields
        $fields = array(
              'customer_bank_accounts' => $data
        );

        return $this->GoCardlessConnect($fields);
    }

    /*fields or cursors = after/before/created_at[gt]/created_at[gte]/created_at[lt]/created_at[lte]/customer/enabled/limit*/
    public function lists($fields=array())
    {
        return $this->GoCardlessConnect($fields, 'GET');
    }

    public function show($customerBankId)
    {
        
        //set POST variables
        $fields = array();

        $this->url = $this->url.'/'.$customerBankId;

        return $this->GoCardlessConnect($fields, 'GET');
    }

    public function update($customerBankId,$data=array())
    {
        /*
          Example data :
          array(
                'metadata'=>$data['metadata'] array 3 items max
              )
        */

        //fields
        $fields = array(
              'customer_bank_accounts' => $data
        );

        $this->url = $this->url.'/'.$customerBankId;

        return $this->GoCardlessConnect($fields, 'PUT');
    }

    public function disable($customerBankId,$data=array())
    {
        /*
          Example data :
          array(
                'metadata'=>$data['metadata'] array 3 items max
              )
        */

        //fields
        $fields = array(
              'customer_bank_accounts' => $data
        );

        $this->url = $this->url.'/'.$customerBankId.'/actions/disable';

        var_dump($this->url);

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
