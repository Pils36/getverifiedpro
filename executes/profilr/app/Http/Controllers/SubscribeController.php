<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User as User;
use App\Subscribe;
use App\Contact;

//Mail
use App\Mail\sendMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{

//Welcome to the Pro-EXECUTES Subscribe Controller | Jan 14, 2019
  public $title = "Ooops";
  public $color = "red";
  public $to = "adenugaadebambo41@gmail.com";
  public $username = "";
  public $default = 0;
  public $name ="Developer";
  public $company ="Pro-EXECUTES"; 
  public $role ="Owner"; 
  public $password =""; 
  public $correctusername; 

  public $email = "";
  public $telephone = "";
  public $country = "";
  public $state = "";
  public $message = "";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('subscribes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validator
      $validator = Validator::make($request->all(),
         array(
             'email' => 'required|email',
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Invalid subscription email', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }

      if($request->email != null)
      {
         $result = Subscribe::where('email', $request->email)->get();
         
         if(count($result) > 0){ 
            $res = "You are already Subscribed";
         }
         else{ 
            $subscribe = new Subscribe;
            $subscribe->email = $request->email;
            $subscribe->save();

            $res = "Thanks for subscribing"; 
            $this->color = "blue";
            $this->title = "Good";

            //Mailer Snippet
            $this->to = $request->email;
            $this->sendMail($this->to, 'Subscribe');
            //END Of Mailer
         }
      }         
      else{
         $res = "Please provide a valid mail";
      }

      // Response Data IF and only IF Validating is True
        $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
        return $this->returnJSON($resData);
    }

   public function returnJSON($data){
    return response()->json($data);
   }

    public function sendMail($objDemoa, $purpose){
      $objDemo = new \stdClass();
      $objDemo->purpose = $purpose;

      if($purpose == "contact" || $purpose == "Contact Info"){
        $objDemo->name = $this->username;
        $objDemo->company = $this->company;

        $objDemo->email = $this->email;
        $objDemo->telephone = $this->telephone;
        $objDemo->country = $this->country;
        $objDemo->state = $this->state;
        $objDemo->message = $this->message;
      }
      elseif($purpose == "Account"){
        $objDemo->name = $this->name;
        $objDemo->company = $this->company;
        $objDemo->mail = $this->to;
        $objDemo->jscid = $this->jscid;
      }
      elseif($purpose == "New User"){
        $objDemo->name = $this->name;
        $objDemo->username = $this->username;
        $objDemo->password = $this->password;
        $objDemo->role = $this->role;
        $objDemo->company = $this->company;
      }
      elseif ($purpose == "Check Up") {
        $objDemo->company = $this->company;
      }

      // Send to mail
      Mail::send(['html'=>'mails.index'], ['name'=>'Pro-EXECUTES'], function($message){
        $objDemo = request()->input('email');
        $message->to($objDemo)->subject('Thank you for subscribing');
        $message->from('Pro-EXECUTES@example.com', 'Pro-EXECUTES');
      });
   }



   
}
