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
use App\OurTeam;
use App\Blog;
use App\Category;
use App\BlogComment;
use App\FAQ;
class AboutUsController extends Controller
{
    public function getAbout(Request $request)
    {
        $ourTeam=OurTeam::take(3)->orderBy('our_team_id','desc')->get();
        // $about=CMSPage
        return view('website.about',compact('ourTeam'));
    }
    public function getService(Request $request)
    {
        return view('website.service');
    }
    public function getPrivacyPolicy()
    {
        $privacyPolicy = CMSPage::where('slug','privacy-policy')->first();
        return view('website.privacyPolicy')->with(compact('privacyPolicy'));
    }
    public function getTerms()
    {
        $terms = CMSPage::where('slug','terms-and-conditions')->first();
        return view('website.termsConditions')->with(compact('terms'));
    }
    public function getFaq()
    {
        $generalFaq = FAQ::where('type','general')->get();
        $otherFaq = FAQ::where('type','other')->get();
        return view('website.faq', compact(['generalFaq','otherFaq']));
    }
    public function getContact(Request $request)
    {
        return view('website.contact');
    }
    public function getBlog(Request $request)
    {
        $blogData=Blog::where('status','1')->orderBy('blog_id','desc');
        $blog = $blogData->paginate(10);
        $category = Category::where('status','1')->get();
        return view('website.blog',compact('blog','category'));
    }
    public function blogDetail($id)
    {
        $blog = Blog::where('blog_id',$id)->where('status','1')->first();
        $comment = BlogComment::where('blog_id',$id)->get();
        $commentCount = BlogComment::where('blog_id',$id)->count();
        $category = Category::where('status','1')->get();
        if($blog==null)
        {
            return view('website.page_not_found');
        }
        if(!empty($blog)){
            return view('website.detail')->with(compact('blog','category','comment','commentCount'));
        }
        else{
            Session::flash('message', 'Blog not found!');
            Session::flash('alert-class', 'error');
            return view('website.home');
        }
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
        $ourTeam=OurTeam::orderBy('our_team_id','desc')->get();
        return view('website.team',compact('ourTeam'));
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

    public function commentStore(Request $request)
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
            $comment = new BlogComment;
            $comment->user_name = $request->user_name;
            $comment->email = $request->email;
            $comment->blog_id = $request->blog_id;
            $comment->comments = $request->comments;
            if ($comment->save()) {
              Session::flash('message', 'Comment Added Succesfully !');
              Session::flash('alert-class', 'success');
              return redirect('/');
            } else {
              Session::flash('message', 'Oops !! Something went wrong!');
              Session::flash('alert-class', 'error');
              return redirect()->back();
            }
        }
    }
}
