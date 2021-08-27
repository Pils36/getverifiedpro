<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Landing Home
    public function home(){
        return view('pages.index');
    }

    //Service Render
    public function service(){
        return view('pages.service');
    }

    //About Us
    public function about(){
        return view('pages.about');
    }

    //Join Us
    public function join(){
        return view('pages.join');
    }

    //Contact Us
    public function contact(){
        return view('pages.contact');
    }

    //Donate
    public function donate(){
        return view('pages.donate');
    }

    
    // FOOTER PAGE:: OUR POLICY
    
    public function render($docs){
        return view('pages.doc')->with([
            'doc' => $docs,
        ]);
    }
}
