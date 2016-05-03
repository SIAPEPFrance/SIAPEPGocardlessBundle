SIAPEP Gocardless's Bundle
============================

Integration of the Gocardless API's into Symfony2.

* Create a parameter called gocardless_enterprise with your gocardless configuration:
```
parameters:
    siapep_gocardless_bundle:
        baseUrl: 'https://api-sandbox.gocardless.com/' # [prod's link] https://api.gocardless.com/ OR [dev's link]https://api-sandbox.gocardless.com
        gocardlessVersion: '2015-07-06' # Api's version Must be the latest
        webhook_secret: REPLACE_WITH_YOUR_WEBHOOK_SECRET
        creditorId: REPLACE_WITH_YOUR_CREDITOR_ID
        token: REPLACE_WITH_YOUR_TOKEN
```
* Add SIAPEPGocardlessBundle to your AppKernel.php
```
    new SIAPEP\GocardlessBundle\SIAPEPGocardlessBundle(),
```            

You will have 8 services with methods for interacting with Gocardless's API endpoints.
  - siapep_gocardless_bundle_customers [create/lists/show/update]
  - siapep_gocardless_bundle_customer_bank_account [create/lists/show/update/disable]
  - siapep_gocardless_bundle_mandates [create/lists/show/update/cancel/reinstate]
  - siapep_gocardless_bundle_payments [create/lists/show/update/cancel/retry]
  - siapep_gocardless_bundle_payouts [lists/show]
  - siapep_gocardless_bundle_refunds [create/lists/show/update]
  - siapep_gocardless_bundle_subscriptions [create/lists/show/update/cancel]
  - siapep_gocardless_bundle_events [lists/show/webhook]

This services includes a method for validating the signature of any webhooks received from GoCardless (assuming you configured the webhook_secret properly).

The following Model will be mapped to your Database automatically:
* Event

This Bundle has not been created with some entities as (Customer, CustomerBankAccount, Mandate, Payment) to let the developper be free to
insert datas in existing models (E.g : if the user use FOSUserbundle to manage his users, maybe he will simply want to store user's Id into "user" table).

The only entity wich have been mapped is "Event".

Documentation and help can be found here:

https://developer.gocardless.com/pro/2015-07-06 (for versioned docs)

https://help.gocardless.com (for GoCardless support contact details)

Example of use :

If you want to create a New User from a controller, just do that :

    public function createCustomerOnGoCardlessAction()
    {
        $gocardless = $this->get('app.siapep_gocardless_bundle_customers');
        return $gocardless->create(
        array(
                'email' => 'contact@yourdomain.com',
                'given_name' => 'Jean-Donald',
                'family_name' => 'Roselin',
                'address_line1'=> 'Champs de Mars, 5 avenue Anatole France',
                'city'=> 'Paris',
                'postal_code'=> '75007',
                'country_code'=> 'FR',
                'language' => 'fr',
                'metadata'=>array('id'=>'007')
              )
        );
    }

    This example will return the Json Response below

    {
      "status":"success",
      "data":{
                "message":{
                    "customers":{
                        "id":"CU0000SSH3FZ21",
                        "created_at":"2016-05-03T22:20:20.950Z",
                        "email":"contact@yourdomain.com",
                        "given_name":"Jean-Donald",
                        "family_name":"Roselin",
                        "company_name":null,
                        "address_line1":"Champs de Mars, 5 avenue Anatole France",
                        "address_line2":null,
                        "address_line3":null,
                        "city":"Paris",
                        "region":null,
                        "postal_code":"75007",
                        "country_code":"FR",
                        "language":"fr",
                        "swedish_identity_number":null,
                        "metadata":{
                            "id":"007"
                        }
                    }
                },
                "datas_sent":{
                    "customers":{
                        "email":"contact@yourdomain.com",
                        "given_name":"Jean-Donald",
                        "family_name":"Roselin",
                        "address_line1":"Champs de Mars, 5 avenue Anatole France",
                        "city":"Paris",
                        "postal_code":"75007",
                        "country_code":"FR",
                        "language":"fr",
                        "metadata":{
                            "id":"007"
                        }
                    }
                }
              }
    }

    Each request to the Gocardless's API returns a JSON data
    (with a sent datas node "datas_sent" and a received datas node "message")
    so you can debug very easily.