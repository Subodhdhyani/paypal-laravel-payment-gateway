<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;
class PaypalController extends Controller
{
    public function paypal(Request $request)
    {
        $total_price= $request->quantity*$request->price;
       //dd($request->all());
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        //dd($paypalToken);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total_price
                    ]
                ]
            ]
        ]);
        //dd($response);
        if(isset($response['id']) && $response['id']!=null) {
            foreach($response['links'] as $link) {
                if($link['rel'] === 'approve') {
                    session()->put('product_name', $request->product_name);
                    session()->put('quantity', $request->quantity);
                    session()->put('address', $request->address);
                    
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('cancel');
        }
    }
    public function success(Request $request)
    {
       //dd($request);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);
        if(isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            // Insert data into database
            $payment = new Payment;
            $payment->payment_id = $response['id'];
            $payment->booking_id = 'BK' . mt_rand(10000, 99999);
            $payment->transcation_id_refund = $response['purchase_units'][0]['payments']['captures'][0]['id'];
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payer_name = $response['payer']['name']['given_name'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = "PayPal";
            $payment->address = session()->get('address');
            $payment->save();
//return "Payment is successful";
           

           // unset($_SESSION['product_name']);
           // unset($_SESSION['quantity']);
             // Remove session variables
    session()->forget('product_name');
    session()->forget('quantity');
    session()->forget('address');
   // return "Payment is successful";
   return redirect()->route('welcome')->with('success', 'Your Payment is Successful');

        } else {
            return redirect()->route('cancel');
        }
    }
    public function cancel()
    {
       
        return redirect()->route('welcome')->with('error', 'Something Wrong. Please try again Later');
       //return "Payment failed";

    }



        function refund($id){
        //find record detail
        $rec = Payment::find($id);
        // Initialize PayPal client
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        // Obtain access token
        $paypalToken = $provider->getAccessToken();
        // Attempt to refund payment
         $response = $provider->refundCapturedPayment(
           $rec->transcation_id_refund, //transcation id for refund seen at top of payment detail in paypal
           $rec->booking_id,  //our created custom unique id for refund
           $rec->amount, // Refund Amount
           'Refunded as Per Customer Request' // Reason for Refund
        );


        if ($response) {
            return redirect()->route('display')->with('success', 'Refunded Successfully');
        } else {
            //return "Refund Failed.";
            return redirect()->route('display')->with('error', 'Something wrong while Refund');
        }
                                        
    }

}