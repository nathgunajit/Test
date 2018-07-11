<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;
use Session;
use Redirect;
//use Carbon\Carbon;
use Mail;

//use App\Http\Models\CommonModel;

class RazorpayController extends Controller
{    
    public function payWithRazorpay()
    {        
        return view('payWithRazorpay');
    }

    public function payment(Request $request)
    {
       
        //Input items of form
        $input = Input::all();
        //get API Configuration 
        $api = new Api(config('razorpay.razor_key'), config('razorpay.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
          //print_r($input);
        $data=$request->all();
        // print_r($payment);
        //print_r($data);
        //$inputdata= array_except($payment,array('_token'));
        //dd($inputdata);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                 $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                //dd($response);
                //echo $response['card_id'].'<BR/>';
                //echo $response['id'].'<BR/>';
                //echo $response['currency'].'<BR/>';
                //echo $response['status'].'<BR/>'; 
                //echo $response->card['type'].'<BR/>';
                //echo $response['name'].'<BR/>';
                //echo $response['created_at'].'<BR/>';
                //echo $response['amount'].'<BR/>';
                //echo $response['status'].'<BR/>'; 
                //echo $response['email'].'<BR/>'; 
                //echo $response['contact'].'<BR/>'; 
                // echo $response['captured'].'<BR/>'; //true
                 
             //if(($response['status']=="captured" && $response['captured']=="true") &&!empty($response['contact']  ))
             // {
			   
			   if($response['captured']==true)
			   {
				   $status=1;
				   
			   }
			   elseif($response['captured']==false)
			   {
				   $status=0;
			   }
			  //$this->basic_email();
			  DB::table('payment_detail')->insert(array(
                                             
                                               'Transaction_id'       =>$response['id'],
											   'status'                =>$status, 
                                               'email'                =>$response['email'],
                                               'contact'              =>$response['contact'],
									           'Transaction_time'     =>'2018-03-09 12:02:02',
											   'Transaction_date'     =>'2018-03-09',
                                               'Transaction_Amount'   => $response['amount'],
											   //'Transaction_Amount' => $response['amount'],
											   //'Transaction_Amount' => $response['amount'],
                                               'Ipaddress'            => $request->ip(),
											   
											   'Payment_Mode_id'      => 2, // Define the view page
                                               'payment_gateway_id'   => 1, // Define the view page
                                               'rti_registration_no'  => 3,  // Define the view page
                                               
                                              ));
                // \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
                //return Redirect::to('rozarpay/sucess')->with('message', 'Login Failed');
                //return Redirect::to('rozarpay/sucess');
           //}
             
             } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }

            // Do something here for store payment details in database...
        }
        
        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
        }
		
  
	  public function PaymentSuccessEmail($mail_to, $otp)
    {
        $to      = $mail_to;
        $subject = 'Mail Test';
        $message = 'Your Otp id '.$otp;
        $headers = 'From: tauqeerfe@gmail.com' . "\r\n" .
           'Reply-To: tauqeerfe@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();
        
        $SaveData = array('password'=>$otp);
        $where = array('login_id'=>$mail_to);
        //echo "HI theer."; die;
        //ini_set('SMTP', 'localhost');	
        //ini_set('smtp_port', 587);	
        if(mail($to, $subject, $message, $headers)) {
            $insert = $this->CommonModel->UpdateData('admin_login', $where, $SaveData);
            return true;
        } else {
            return false;
        }
    }
		
		
    }


