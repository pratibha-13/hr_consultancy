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
        return view('website.home',compact(['ourTeam']));
    }
}
