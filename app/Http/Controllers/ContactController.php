<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
//use App\Http\Request;
use Mail;
//use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
	 public function getContact()
    {
      return view('pages.contact');
    }
	
		
		public function postContact(Request $request)
{
	

		$data=array(
		'email'=> $request->email,
		'subject'=> $request->subject,
		'bodyMessage'=> $request->message
		);
		
Mail::send('mail', $data, function($message) use ($data) {
    $message->to($data['email']);
    $message->subject('RTI OnLine Testing Mail');
    $message->from('developergunajit@gmail.com','RTI Online');
});

        //$this->validate($request,[
	     //'email'=>'requires|email',
		//'subject'=>'min:10',
		//'message'=>'min:100',
		//]);
		//dd($request->subject);
		//dd($request->email);
		//dd($request->message);
		//die;
		//$request->input('email');
		
}

    
}
