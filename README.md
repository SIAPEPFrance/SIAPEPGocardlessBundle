SIAPEP Gocardless's Bundle
============================

Integration of the Gocardless API's into Symfony2.

* Create a parameter called gocardless_enterprise with your gocardless configuration:
```
parameters:
    gocardless_enterprise:
        baseUrl: 'https://api.gocardless.com/'
        gocardlessVersion: '2015-07-06'
        webhook_secret: XXXXXXXXXXXXXXXXXXXXXX
        creditorId: XXXXXXXXXXXXXX
        token: XXXXXXXXXXXXXXXXXXXXXXXXXXX
```
* Add SIAPEPGocardlessBundle to your AppKernel.php
```
    new SIAPEP\GocardlessBundle\SIAPEPGocardlessBundle(),
```            

You will have 8 services with methods for interacting with Gocardless's API endpoints.
  - siapep_gocardless_bundle_customers
  - siapep_gocardless_bundle_customer_bank_account
  - siapep_gocardless_bundle_mandates
  - siapep_gocardless_bundle_payments
  - siapep_gocardless_bundle_payouts
  - siapep_gocardless_bundle_refunds
  - siapep_gocardless_bundle_subscriptions
  - siapep_gocardless_bundle_events

This services includes a method for validating the signature of any webhooks received from GoCardless (assuming you configured the webhook_secret properly).

The following Models will be mapped to your Database automatically:
* Customer
* CustomerBankAccount
* Mandate
* Payment
* Events

Documentation and help can be found here:

https://developer.gocardless.com/pro/2015-07-06 (for versioned docs)

https://help.gocardless.com (for GoCardless support contact details)
# SIAPEPGocardlessBundle
