<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//DB Facade
use Illuminate\Support\Facades\DB;
//Mail
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Mail;
//Storage
use Illuminate\Support\Facades\Storage;
//Hash
use Illuminate\Support\Facades\Hash;
//Session
use Session;
//Model
use App\Corporate;
use App\User;
class GetstartedController extends Controller
{
    public $color = "red";
    public $title = "Error";
    public $msg = "Fail to execute";
    public $state = "0";

    public function index(Request $request){

      //Validator
      $validator = Validator::make($request->all(),
         array(
             'first_name' => 'required',
             'execid' => 'required',
             'last_name' => 'required',
             'profession' => 'required',
             'email' => 'required|email',
             'city' => 'required',
             'industry' => 'required',
             'country' => 'required',
             'terms' => 'required',
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => $this->msg, 'color' => $this->color, 'title' => $this->title, 'state' => $this->state];
         return $this->returnJSON($resData);
      }

      // Email Exists
      $checkCompany = Corporate::where('email', $request->email)->get();
      if(count($checkCompany) > 0){
        // Response Data IF and only IF Validating is True
        $this->msg = "Account Exists";
        $resData = ['res' => $this->msg, 'color' => $this->color, 'title' => $this->title, 'state' => $this->state];
        return $this->returnJSON($resData);
      }else{
        //Update or Create With Mass Assignment
        Corporate::updateOrCreate(
          ['execid' => $request->execid],
          ['firstname' => $request->first_name, 'lastname' => $request->last_name, 'profession' => $request->profession, 'city' => $request->city, 'industry' => $request->industry, 'country' => $request->country, 'terms' => $request->terms, 'email' => $request->email]
        );

        //Success
        $this->msg = "Stage 1"; 
        $this->color = "blue";
        $this->title = "Success";
        $this->state = "1";

        // Response Data IF and only IF Validating is True
        $resData = ['res' => $this->msg, 'color' => $this->color, 'title' => $this->title, 'state' => $this->state];
        return $this->returnJSON($resData);        
      }

    }    

    public function user(Request $request){

      //Validator
      $validator = Validator::make($request->all(),
         array(
             'first_name' => 'required',
             'execid' => 'required',
             'last_name' => 'required',
             'email' => 'required|email',
             'password' => 'required',
             'username' => 'required'
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => $this->msg, 'color' => $this->color, 'title' => $this->title, 'state' => $this->state];
         return $this->returnJSON($resData);
      }

      // Email Exists
      $checkUserExist = User::where('execid', $request->execid)->where('email', $request->email)->orWhere('username', $request->username)->get();
      if(count($checkUserExist) > 0){
        // Response Data IF and only IF Validating is True
        $this->msg = "User Account Exists";
        $resData = ['res' => $this->msg, 'color' => $this->color, 'title' => $this->title, 'state' => $this->state];
        return $this->returnJSON($resData);
      }else{
        //Update or Create With Mass Assignment
        User::updateOrCreate(
          ['execid' => $request->execid],
          ['firstname' => $request->first_name, 'lastname' => $request->last_name, 'email' => $request->email, 'username' => $request->username, 'password' => bcrypt($request->password), 'role' => 'Super User']
        );

        //Success
        $this->msg = "Stage 3"; 
        $this->color = "blue";
        $this->title = "Success";
        $this->state = "1";

        // Response Data IF and only IF Validating is True
        $resData = ['res' => $this->msg, 'color' => $this->color, 'title' => $this->title, 'state' => $this->state];
        return $this->returnJSON($resData);        
      }

    }

   public function returnJSON($data){
      return response()->json($data);
   }

}
