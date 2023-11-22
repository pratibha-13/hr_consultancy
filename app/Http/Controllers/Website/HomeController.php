<?php

namespace App\Http\Controllers\Website;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use Auth;
use App\OurTeam;
use App\OurClientSay;
use App\Blog;
use App\HomePageSlider;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('landingPage');
    }
    /**
     * Landing page with details
     */
    public function landingPage(Request $request)
    {
        $ourTeam=OurTeam::take(3)->orderBy('our_team_id','desc')->get();
        $ourClientSay=OurClientSay::where('status','1')->get();
        $blog=Blog::where('status','1')->orderBy('blog_id','desc')->take(3)->get();
        $mainSlider=HomePageSlider::where('status','1')->orderBy('home_page_slider_id','desc')->get();
        return view('website.home',compact(['ourTeam','ourClientSay','blog','mainSlider']));
    }
}
