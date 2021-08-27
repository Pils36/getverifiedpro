<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User as User;
use App\Contact;

//Mail
use App\Mail\sendMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    //Welcome to the Pro-EXECUTES Contact Controller | Jan 14, 2019
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

    // public function __construct(Request $request){
        
        // dd($request->all());
    // }

    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email',
            'need' => 'required',
            'message' => 'required',
        ]);

      // Check validation processes
      if($validator->fails())
      {
        // Response Data
        $resData = ['res'=> 'Please provide missing details', 'color'=> $this->color, 'title'=>$this->title];
        return $this->returnJSON($resData);
      }

      if(null != $request->message) {
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->email = $request->email;
        $contact->need = $request->need;
        $contact->message = $request->message;

        // dd($contact);


        // Mailer Snippet
        $this->to = $request->email;
        $this->sendMail($this->to, 'Contact');
        //END Of Mailer            

        //Mailer Snippet to info Admin
        $this->sendMail('adenugaadebambo41@gmail.com', 'Contact Info');
        //END Of Mailer

        $contact->save();

        $res = "Message sent";
        $this->color = "blue";
        $this->title = "Good";

      }
      else{
         $res = "Please fill all fields";
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

      // Send to mail
      Mail::send(['html'=>'contact.contactmail'], ['name'=>'Pro-EXECUTES'], function($message){
        $objDemo = request()->input('email');
        $message->to($objDemo)->subject('Customer Support');
        $message->from('Pro-EXECUTES@example.com', 'Pro-EXECUTES');
      });
   }
}