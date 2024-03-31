## Requirement

1) Create Paypal Developer Account and Inside this, then Create Sandbox Account and then,Inside  create two account one business(for accept) and other Personal(for payment) sanbox account and then by this two credentials login to sandbox paypal login 
2) Paypal Package used :https://github.com/srmklive/laravel-paypal.git 

## Changes inside .env
1) Set Database name = paypal 
2) Api Detail Setup
     <!-- PayPal API Mode Values: sandbox or live (Default: live)-->
     - PAYPAL_MODE=sandbox

     <!-- PayPal Setting & API Credentials - sandbox -->
     - PAYPAL_SANDBOX_CLIENT_ID=Aesr8dqqrcaOgjDaBIXeFb0wv5Gr6zSxdFY
     - PAYPAL_SANDBOX_CLIENT_SECRET=EBD6fl4tiZ8m0CGELWBm3H5C3ceyUvH

     <!-- PayPal Setting & API Credentials - live -->
    
     - PAYPAL_LIVE_CLIENT_ID=
     - PAYPAL_LIVE_CLIENT_SECRET=

