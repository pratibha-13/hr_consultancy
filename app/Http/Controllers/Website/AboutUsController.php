<?php

namespace App\Http\Controllers\Website;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\CMSPage;
use App\freeQuote;
use Validator;
use DB;
use Session;
use App\ContactUs;
use App\OurClientSay;

class AboutUsController extends Controller
{
    public function getAbout(Request $request)
    {
        return view('website.about');
    }
    public function getService(Request $request)
    {
        return view('website.service');
    }

    public function getContact(Request $request)
    {
        return view('website.contact');
    }
    public function getBlog(Request $request)
    {
        return view('website.blog');
    }
    public function getBlogDetail(Request $request)
    {
        return view('website.detail');
    }
    public function getFeature(Request $request)
    {
        return view('website.feature');
    }
    public function getQuote(Request $request)
    {
        return view('website.quote');
    }
    public function getTeam(Request $request)
    {
        return view('website.team');
    }
    public function getTestimonial(Request $request)
    {
        $ourClientSay=OurClientSay::where('status','1')->get();
        return view('website.testimonial',compact('ourClientSay'));
    }

    public function store(Request $request)
    {
        $rules = [
        ];
        $messages = [
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $freequote = new freeQuote;
            $freequote->full_company_name = $request->full_company_name;
            $freequote->email = $request->email;
            $freequote->contact_number = $request->contact_number;
            if ($freequote->save()) {
              Session::flash('message', 'Free Quote Added Succesfully !');
              Session::flash('alert-class', 'success');
              return redirect('/');
            //   return redirect()->refresh();
            } else {
              Session::flash('message', 'Oops !! Something went wrong!');
              Session::flash('alert-class', 'error');
              return redirect()->back();
            }
        }
    }
}
