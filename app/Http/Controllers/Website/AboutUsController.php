<?php

namespace App\Http\Controllers\Website;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\CMSPage;

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
        return view('website.testimonial');
    }
}
