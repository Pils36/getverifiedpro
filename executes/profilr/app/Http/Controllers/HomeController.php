<?php

namespace App\Http\Controllers;

use App\Subscriber as Subscribe;
use App\Contact as Contact;
use App\Corporate as Corporate;
use App\Package as Package;
use App\Upload as Upload;
use App\Avatar as Avatar;
use App\Assign;
use App\Activate;
use App\User;
use App\Pay;
use App\Paid;
use App\Blog;

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

class HomeController extends Controller
{
  //Welcome to the JSC_Globals Home Controller | Nov 15, 2018
  public $title = "Ooops";
  public $color = "red";
  public $to = "babalola_ebenezer58@yahoo.com";
  public $username = "";
  public $default = 0;
  public $name ="Developer";
  public $company ="JSC_Globals"; 
  public $role ="Owner"; 
  public $password =""; 
  public $correctusername; 

  public $email = "";
  public $telephone = "";
  public $country = "";
  public $state = "";
  public $message = "";

  public $cfo = "0";
  public $payroll = "0";
  public $jscid = "";

  public $cfopaid =  0;
  public $payrollpaid =  0;
  public $cfoplan =  0;
  public $discount =  0;
  public $total =  0;
  public $invoice_id = 0;
  public $invoice_description = 0;

  public $blog;

   public function __construct(){
    // dd(session::all());
    $blog = Blog::where('title', '!=', null)->inRandomOrder()->take(2)->get();
    $this->blog = $blog;
   }

  //Root Method
  public function index(){    
    return view('main.pages.index')->with('page', 'Home')->with('blog', $this->blog);

  }     

  public function contact(){
    return view('main.pages.contact')->with('page', 'Contact')->with('blog', $this->blog);
  }     

  public function accounting(){
    return view('main.pages.accounting')->with('page', 'Accounting')->with('blog', $this->blog);
  }     

  public function payroll(){
    return view('main.pages.payroll')->with('page', 'Payroll')->with('blog', $this->blog);
  }     

  public function corporate(){
    return view('main.pages.corporate')->with('page', 'Corporate')->with('blog', $this->blog);
  }     

  public function get_started(){
    return view('main.pages.started')->with(['page' => 'Get_started', 'jscid' => "JSC_Globals".time()])->with('blog', $this->blog);
  }  

  public function render($doc){
    return view('main.pages.docs')->with(['page' => ucwords($doc), 'doc' => $doc])->with('blog', $this->blog);
  }  
  
  public function renderwp(){
    $getCorporate = Corporate::where('jscid', session('thisuser'))->get();
    $getUsers = User::where('jscid', session('thisuser'))->get()->first();
    $getAssigncfo = Assign::select('users.useremail', 'users.userphone')->join('users', 'users.userusername', '=', 'assigns.cfo')->where('assigns.jscid', session('thisuser'))->get();
    $getAssignbkp = Assign::select('users.useremail', 'users.userphone')->join('users', 'users.userusername', '=', 'assigns.bookkeeping')->where('assigns.jscid', session('thisuser'))->get();
    $getAssignacc = Assign::select('users.useremail', 'users.userphone')->join('users', 'users.userusername', '=', 'assigns.accounting')->where('assigns.jscid', session('thisuser'))->get();

    return view('main.pages.welcomepackage')->with('corporate', $getCorporate)
                                            ->with('users', $getUsers)
                                            ->with('assigncfo', $getAssigncfo)
                                            ->with('assignbkp', $getAssignbkp)
                                            ->with('assignacc', $getAssignacc);
  } 
  public function success(){
    return view('success');
  }

  public function myaccount(Request $request){
    //  $request->session()->flush();
    // return session::all();
    // $request->session()->get('thisuser');

    if(isset($_GET['user'])){
      $user = User::where('userusername', $_GET['user'])->first();
      // dd($user);
      if($user){
        if($user->userrole == "Super" || $user->userrole == "Staff"){
          return redirect()->route('AccountAdmin', ['user' => $_GET['user']]);
        }
          $this->correctusername = $_GET['user'];
      }else{
        $this->correctusername = $_GET['user'];
      }
    }
      return view('index')->with('username', $this->correctusername);
  }     

  public function myaccountadmin(Request $request){
    if(isset($_GET['user'])){
      $user = User::where('userusername', $_GET['user'])->first();
      // dd($user);
      if($user){
        if($user->userrole == "onwer" || $user->userrole == "manage"){
          return redirect()->route('Account', ['user' => $_GET['user']]);
        }
          $this->correctusername = $_GET['user'];
      }else{
        $this->correctusername = $_GET['user'];
      }
    }
      return view('adminlogin')->with('username', $this->correctusername);
  }   

  public function about(){
    return view('main.pages.about')->with('page', 'About')->with('blog', $this->blog);
  }

  public function ajaxlogin(Request $request){
    //Validator
    $validator = Validator::make($request->all(),
       array(
           'username' => 'required',
           'password' => 'required'
       ));

    if ($validator->fails()) {
       //Response Data
       $resData = ['res' => 'Please do fill login form', 'color' => $this->color, 'title' => $this->title ];
       return $this->returnJSON($resData);
    }

    $find = User::where(['userusername' => $request->username])->where(['userstate' => 'Active'])->get();


      if(count($find) > 0){
  if($find[0]['userrole'] != "Super" && $find[0]['userrole'] != "Staff")
    {
          if (Hash::check($request->password, $find['0']['userpassword']))
          {
            $res = "Authentication Successful";
            $this->color = "blue";
            $this->title = "Done";

            $findactive = Activate::where(['jscid' => $find[0]['jscid']])->where(['state' => 'Active'])->count();
            if($findactive == 1){
              $request->session()->put(['thisstate' => "Active"]);
            }else{
              $request->session()->put(['thisstate' => "Inactive"]);
            }
            //Set Session Identifier
            $request->session()->put(['thisuser' => $find[0]['jscid'], 'thisuserusername' => $find[0]['userusername'], 'thisusername' => $find[0]['username'], 'thisuserrole' => $find[0]['userrole'], 'thisusertitle' => $find[0]['usertitle'], 'thisuseremail' => $find[0]['useremail']]);

              //Mailer Snippet
              // $this->to = $find[0]['useremail'];
              // $this->sendEmail($this->to, 'Logged');
              //END Of Mailer

          }else{
            $res = "Credentials Mis-Match";
          }
    }
    else{
      $res = "Admin";
    }
      }else{
        $res = "Ooops... No User Match !!!";
      }      


    // Response Data IF and only IF Validating is True
    $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];

    return $this->returnJSON($resData);
  }     

   public function ajaxsubscribe(Request $request){
      //Validator
      $validator = Validator::make($request->all(),
         array(
             'email' => 'required|email'
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Invalid subscription email', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }

      if(null != $request->email)
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
            $this->sendEmail($this->to, 'Subscribe');
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

   public function ajaxcontact(Request $request){
      //Validator
      $validator = Validator::make($request->all(),
         array(
             'name' => 'required',
             'email' => 'required|email',
             'telephone' => 'required',
             'country' => 'required',
             'company' => 'required',
             'state' => 'required',
             'message' => 'required',
             'email' => 'required|email',
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Please do complete the contact form', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }

      if(null != $request->state)
      {

            $contact = new Contact;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->telephone = $request->telephone;
            $contact->company = $request->company;
            $contact->country = $request->country;
            $contact->state = $request->state;
            $contact->message = $request->message;
            $contact->save();

            //Success
            $res = "Thanks for contacting us"; 
            $this->color = "blue";
            $this->title = "Good";

            $this->username = $request->name;
            $this->company = $request->company;
            $this->email = $request->email;
            $this->telephone = $request->telephone;
            $this->country = $request->country;
            $this->state = $request->state;
            $this->message = $request->message;

            //Mailer Snippet
            $this->to = $request->email;
            $this->sendEmail($this->to, 'Contact');
            //END Of Mailer            

            //Mailer Snippet to info Admin
            $this->sendEmail('info@jscglobalaccountingservices.com', 'Contact Info');
            //END Of Mailer

      }         
      else{
         $res = "Please fill all fields";
      }

      // Response Data IF and only IF Validating is True
      $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
      return $this->returnJSON($resData);
   }   

   public function ajaxcorporate(Request $request){
      //Validator
      $validator = Validator::make($request->all(),
         array(
             'title' => 'required',
             'jscid' => 'required',
             'name' => 'required',
             'company' => 'required',
             'address' => 'required',
             'industry' => 'required',
             'specialization' => 'required',
             'city' => 'required',
             'state' => 'required',
             'country' => 'required',
             'email' => 'required|email',
             'phone' => 'required',
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Please do complete the form', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }

      // company Exists
      $checkCompany = Corporate::where('company', $request->company)->get();
      if(count($checkCompany) > 0){
        // Response Data IF and only IF Validating is True
        $res = "Account Exists";
        $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
        return $this->returnJSON($resData);
      }else{
        //Update or Create With Mass Assignment
        Corporate::updateOrCreate(
          ['jscid' => $request->jscid],
          ['company' => $request->company, 'title' => $request->title, 'name' => $request->name, 'address' => $request->address, 'industry' => $request->industry, 'specialization' => $request->specialization, 'city' => $request->city, 'state' => $request->state, 'country' => $request->country, 'email' => $request->email, 'phone' => $request->phone]
        );
        Package::insert(['jscid' => $request->jscid]);
        User::insert(['jscid' => $request->jscid]);
        Activate::insert(['jscid' => $request->jscid, 'state' => 'Inactive']);
        Upload::insert(['jscid' => $request->jscid]);
        Avatar::insert(['jscid' => $request->jscid]);
        Assign::insert(['jscid' => $request->jscid]);
        Pay::insert(['jscid' => $request->jscid]);

            //Mailer Snippet
            $this->to = $request->email;
            $this->company = $request->company;
            $this->name = $request->name;
            $this->jscid = $request->jscid;
            $this->sendEmail($this->to, 'Account');
            //END Of Mailer

        //Success
        $res = "Stage 1"; 
        $this->color = "blue";
        $this->title = "Success";

        // Response Data IF and only IF Validating is True
        $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
        return $this->returnJSON($resData);        
      }


   }   

   public function ajaxpackage(Request $request){
      //Validator
      $validatorcfo = Validator::make($request->all(),
         array(
             'jscid' => 'required',
             'cfo' => 'required'
         ));      
      $validatorpackage = Validator::make($request->all(),
         array(
             'package' => 'required',
         ));

      if ($validatorcfo->fails() && $validatorpackage->fails()) {
         //Response Data
         $resData = ['res' => 'Please do select a package(s)', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }

      //Update or Create With Mass Assignment
      Package::updateOrCreate(
        ['jscid' => $request->jscid],
        ['payroll' => $request->package, 'cfo' => $request->cfo]
      );

      //Success
      $res = "Stage 2"; 
      $this->color = "blue";
      $this->title = "Success";

      // Response Data IF and only IF Validating is True
      $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
      return $this->returnJSON($resData);
   }   

   public function ajaxuser(Request $request){

    if($request->action == "update"){
      //Validator
      $validator = Validator::make($request->all(),
         array(
             'jscid' => 'required',
             'username' => 'required',
             'usertitle' => 'required',
             'userrole' => 'required',
             'userusername' => 'required',
             'useremail' => 'required',
             'userphone' => 'required'
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Please do complete the form', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }
    }
    elseif($request->action == "delete" || $request->action == "activate"){
      $validator = Validator::make($request->all(),
         array(
             'jscid' => 'required',
             'userusername' => 'required|alpha',
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Provide Client to process', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }    
    }
      //Update or Create With Mass Assignment
      DB::beginTransaction();
      try {
      if($request->action == "insert"){
      User::insert(
      ['jscid' => $request->jscid, 'userusername' => $request->userusername, 'username' => $request->username, 'usertitle' => $request->usertitle, 'userrole' => $request->userrole, 'userpassword' => bcrypt($request->userpassword), 'useremail' => $request->useremail, 'userphone' => $request->userphone, 'profile' => null]
    );

      }      
      // elseif($request->action == "update"){
      // User::where('jscid', $request->jscid)
      //       ->where('userusername', $request->userusername)
      //       ->update(['username' => $request->username, 'usertitle' => $request->usertitle, 'userrole' => $request->userrole, 'useremail' => $request->useremail, 'userphone' => $request->userphone]);
      // }      
      elseif($request->action == "delete"){
      // User::where('jscid', $request->jscid)->where('username', $request->userusername)->delete();
      DB::select('delete from users where userusername = :username and jscid = :jscid', ['username' => $request->userusername, 'jscid' => $request->jscid]);
      }
      elseif($request->action == "activate"){
      Activate::where('jscid', $request->jscid)->update(['state' => $request->userusername]);              
      }      
      elseif($request->action == "update"){

      if(null != $request->file('file')){
        $file = $request->file('file');
        //Check Extension
        $fileextension = $this->checkExtension($file);
        //Move Uploaded File
        $upload = $this->uploadtodirectory($file, $fileextension, $file->getRealPath());
        if ($upload == 1) {
          User::where(['jscid' => $request->jscid, 'userusername' => $request->userusername])->update(['profile' => $file->getClientOriginalName()]);
        }
      }

      User::where(['jscid' => $request->jscid, 'userusername' => $request->userusername])->update(['username' => $request->username, 'usertitle' => $request->usertitle, 'userrole' => $request->userrole, 'useremail' => $request->useremail, 'userphone' => $request->userphone]);  

      }      
      else{
      User::updateOrCreate(
        ['jscid' => $request->jscid],
        ['userusername' => $request->userusername, 'username' => $request->username, 'usertitle' => $request->usertitle, 'userrole' => $request->userrole, 'useremail' => $request->useremail, 'userphone' => $request->userphone, 'userpassword' => bcrypt($request->userpassword), 'userstate' => 'Inactive']
      );        
      }

        DB::commit();
      //Success
      $res = "Action complete"; 
      $this->color = "blue";
      $this->title = "Success";
      } catch (\Exception $e) {
          DB::rollback();
          $res = "User Process Failed";
      }

      if($request->action != "update" && $request->action != "delete" && $request->action != "activate"){
        //Mailer Snippet
        $findCompany = Corporate::where('jscid', $request->jscid)->get()->first();
        if(null != $findCompany){
          $this->company = "JSC Global Accounting Services";
          $this->to = $request->useremail;
          $this->name = $request->username;
          $this->username = $request->userusername;
          $this->password = $request->userpassword;
          $this->role = $request->userrole;
          $this->sendEmail($this->to, 'New User');          
          // $this->company = $findCompany->company;
          // $this->to = $request->useremail;
          // $this->name = $request->username;
          // $this->username = $request->userusername;
          // $this->password = $request->userpassword;
          // $this->role = $request->userrole;
          // $this->sendEmail($this->to, 'New User');
        }
        //END Of Mailer        
      }
      elseif($request->action == "delete"){

      }

    if($request->action != "update"){
      // Response Data IF and only IF Validating is True
      $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
      return $this->returnJSON($resData);
    }
    else{
      return back();
    }
   }   

   public function ajaxupload(Request $request){
      //Validator
    // dd($request->form);
      if($request->form == "get_started"){
          $request->session()->flush();
      }

      $validator = Validator::make($request->all(),
         array(
             'jscid' => 'required',
             'file' => 'required'
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Upload Failed', 'color' => $this->color, 'title' => $this->title ];
         return back()->with('err', 'Agreement upload failed');
         // return $this->returnJSON($resData);
      }

      $file = $request->file('file');
      //Check Extension
      $fileextension = $this->checkExtension($file);
      //Move Uploaded File
      $upload = $this->uploadtodirectory($file, $fileextension, $file->getRealPath());
      if ($upload == 1) {
        //Upload Image To DB

      DB::beginTransaction();
      try {

        if($request->form == "action" || $request->form == "getstarted_action"){
        Upload::updateOrCreate(['jscid' => $request->jscid],['file' => $request->file->getClientOriginalName()]);
        }
        elseif($request->form == "avatar"){
        Avatar::where('jscid', $request->jscid)->update(['avatar' => $request->file->getClientOriginalName()]);
        }

        DB::commit();
        if(null != session('thisuser')){
          return redirect()->route('Action');
        }
        elseif($request->form == "getstarted_action"){
            return view('notice', ['user', $request->name]);
        }
        else{
          return redirect('Account/Login?user='.$request->name);
        }
      } catch (\Exception $e) {
          DB::rollback();
        if(null != session('thisuser')){
          return redirect()->route('Action');
        }
      }

        //Success
        $res = "Upload Successful"; 
        $this->color = "blue";
        $this->title = "Good";
      }else{
        $res = "Upload Failed: Check Extension";
      }

      // Response Data IF and only IF Validating is True
      $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
      return redirect('Account/Login?user='.$request->name);
   }

    public function uploadtodirectory($file, $fileextension, $path){
        // Excel : pricelists
        if($fileextension == "xls" || $fileextension == "xlsx" || $fileextension == "csv"){
            $destinationPath = 'uploads/upsl';
        }
        //Images : Captures
        elseif($fileextension == "jpg" || $fileextension == "png" || $fileextension == "gif" || $fileextension == "PNG"  || $fileextension == "PDF"  || $fileextension == "pdf"  || $fileextension == "html"   || $fileextension == "HTML"){
            $destinationPath = 'uploads/agreement';
            //Move file to directory
            $move = $file->move($destinationPath,$file->getClientOriginalName());
            if($move){return 1;}else{return 0;}
        }
        //Videos : Movies
        elseif($fileextension == "avi" || $fileextension == "mpeg" || $fileextension == "mp4"){
            $destinationPath = 'uploads/videos';
        }        

    }    

    public function checkExtension($file){
        return $fileextension = $file->getClientOriginalExtension();
    }  

   public function ajaxpay(Request $request){
      //Validator
      $validator = Validator::make($request->all(),
         array(
             'jscid' => 'required',
             'corporate_company' => 'required',
             'corporate_name' => 'required',
             'useremail' => 'required|email',
             'userphone' => 'required'
         ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Payment Failed', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }

      //Insert
      Pay::updateOrCreate(['jscid' => session('thisuser')], ['cfo' => $request->cfo, 'payroll' => $request->payroll]);

      //Paid Value
      Paid::updateOrCreate(['jscid' => session('thisuser')],
        ['cfoplan' => $request->cfoplan, 'invoice_id' => $request->ref, 'cfopaid' => $request->cfoval, 'payrollpaid' => $request->payrollval, 'ACK' => $request->status, 'PAYMENTINFO_0_TRANSACTIONID' => $request->trans, 'PAYMENTINFO_0_AMT' => $request->cfoval+$request->payrollval-$request->discount, 'PAYMENTINFO_0_CURRENCYCODE' => 'NGN', 'PAYMENTINFO_0_PAYMENTSTATUS' => $request->message]
      );

      //Success
      $res = "Payment Successful"; 
      $this->color = "blue";
      $this->title = "Success";

      //Mailer Snippet
      $this->to = $request->useremail;
      $this->company = $request->corporate_company;
      $this->name = $request->corporate_name;
      $this->cfo =  $request->cfo;
      $this->payroll =  $request->payroll;

      $this->cfopaid =  $request->cfoval;
      $this->payrollpaid =  $request->payrollval;
      $this->cfoplan =  $request->cfoplan;
      $this->discount =  $request->discount;
      $this->total =  $request->cfoval+$request->payrollval;
      $this->invoice_id =  $request->trans;
      $this->invoice_description =  $request->ref;

      $this->sendEmail($this->to, 'Payment');
      //END Of Mailer

      // Response Data IF and only IF Validating is True
      $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
      return $this->returnJSON($resData);

      return view('success');
   }   

   public function ajaxfetchstorage(Request $request){
      //Validator
      $validator = Validator::make($request->all(),
         array( 'file' => 'required' ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Please do provide file to download', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
      }

      //Success
      $res = "File Downloaded"; 
      $this->color = "blue";
      $this->title = "Success";

      // Response Data IF and only IF Validating is True
      $resData = ['res' => $res, 'color' => $this->color, 'title' => $this->title ];
      return $this->returnJSON($resData);
   }

   public function validateData($data){
      // return $data;
      //Validator
     $validator = Validator::make($data,
         array(
             'email' => 'required|integer'
         ));

     if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Please do complete the form', 'color' => $this->color, 'title' => $this->title ];
         return $this->returnJSON($resData);
     }
   }

   public function message(Request $request){
      $validator = Validator::make($request->all(),
         array( 'company' => 'required', 'email' => 'required' ));

      if ($validator->fails()) {
         //Response Data
         $resData = ['res' => 'Please do provide client', 'color' => $this->color, 'title' => $this->title ];
      }

      //Mailer Snippet
      $this->to = $request->email;
      $this->company = $request->company;
      $this->sendEmail($this->to, 'Check Up');
      //END Of Mailer

      $resData = ['res' => 'Check Up Mail Sent', 'color' => 'blue', 'title' => 'Success' ];
      return $this->returnJSON($resData);


   }

  public function newuser(Request $request){
    // dd($request->all());
    $profile = null;

    if (null != $request->file('file')) {
      $file = $request->file('file');

      //Check Extension
      $fileextension = $this->checkExtension($file);

      //Move Uploaded File
      $upload = $this->uploadtodirectory($file, $fileextension, $file->getRealPath());

      if($upload == 1){
        $profile = $file->getClientOriginalName();
      }
      else{
        return redirect()->back()->with('syncstate', 'Resume Upload Failed');
      }

    }

    if (null != $request->userusername) {

      $insertuser = User::insert(['jscid' => session('thisuser'), 'userusername' => $request->userusername, 'username' => $request->username, 'usertitle' => $request->usertitle, 'userrole' => $request->userrole, 'userpassword' => bcrypt($request->userpassword), 'useremail' => $request->useremail, 'userphone' => $request->userphone, 'profile' => $profile]);

      if($insertuser){
        $findCompany = Corporate::where('jscid', session('thisuser'))->get()->first();
        if(null == $findCompany){
          $this->company = "JSC Global Accounting Services";
        }
        else{
          $this->company = $findCompany->company;
        }
          $this->to = $request->useremail;
          $this->name = $request->username;
          $this->username = $request->userusername;
          $this->password = $request->userpassword;
          $this->role = $request->userrole;
          $this->sendEmail($this->to, 'New User');
        
        return redirect()->back()->with('syncstate', 'Success');
      }
      else{
        return redirect()->back()->with('syncstate', 'Failed Insertion');
      }

    }
    else{
      return redirect()->back()->with('syncstate', 'Failed Insertion');
    }

  }

   public function ResendInvite(Request $request){
        $company = "JSC Global Accounting Services";

        //Mailer Snippet
        $findUser = Corporate::select('company','useremail', 'username', 'userusername', 'userpassword', 'userrole')
                                  ->join('users', 'users.jscid', '=', 'corporates.jscid')
                                  ->where('userusername', $request->userusername)
                                  ->get()
                                  ->first();
        if(!$findUser){
        $findUser = User::select('useremail', 'username', 'userusername', 'userpassword', 'userrole')
                                  ->where('userusername', $request->userusername)
                                  ->get()
                                  ->first();
        }
        else{
          $company = $findUser->company;
        }


        if(null != $findUser){
          $this->company = $company;
          $this->to = $findUser->useremail;
          $this->name = $findUser->username;
          $this->username = $findUser->userusername;
          $this->password = $findUser->userpassword;
          $this->role = $findUser->userrole;
          $this->sendEmail($this->to, 'New User');

      $resData = ['res' => 'Invite Resent', 'color' => 'blue', 'title' => 'Success' ];
      return $this->returnJSON($resData);
        }
        //END Of Mailer 


   }     

   public function returnJSON($data){
      return response()->json($data);
   }      

   public function sendEmail($objDemoa, $purpose){
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
      elseif ($purpose == "Payment") {
        $objDemo->company = $this->company;
        $objDemo->name = $this->name;
      
        $objDemo->cfoval =  $this->cfo;
        $objDemo->payrollval =  $this->payroll;        
        $objDemo->cfopaid =  $this->cfopaid;
        $objDemo->payrollpaid =  $this->payrollpaid;
        $objDemo->cfoplan =  $this->cfoplan;
        $objDemo->discount =  $this->discount;
        $objDemo->total =  $this->total;
        $objDemo->invoice_id =  $this->invoice_id;
        $objDemo->invoice_description =  $this->invoice_description;
      }      
      elseif ($purpose == "Check Up") {
        $objDemo->company = $this->company;
      }

      Mail::to($objDemoa)
            ->send(new sendEmail($objDemo));
   }

   public function logout(Request $request){
      
      if(session::has('thisuserrole') && (session('thisuserrole') == "Super" || session('thisuserrole') == "Staff"))
      {$request->session()->flush();
        return redirect()->route('AccountAdmin', ['user' => session('thisuserusername')]);
      }else{$request->session()->flush();
       return redirect()->route('Account', ['user' => session('thisuserusername')]);
      }
      
   }


}