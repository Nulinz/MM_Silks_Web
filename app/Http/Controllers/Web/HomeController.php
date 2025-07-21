<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('web.pages.index');

    }
    public function aboutus()
    {
        return view('web.pages.about-us');
    }

    public function contactus()
    {
        return view('web.pages.contact-us');
    }

    public function terms()
    {
        return view('web.pages.terms-conditions');
    }

    public function privacy()
    {
        return view('web.pages.privacy-policy');
    }

    public function refund()
    {
        return view('web.pages.refund-policy');
    }
}
