<?php

namespace App\Http\Controllers\Website;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\FAQ;

class FAQController extends Controller
{
    public function getFaq()
    {
        $generalFaq = FAQ::where('type','general')->get();
        $otherFaq = FAQ::where('type','other')->get();
        return view('website.faq', compact(['generalFaq','otherFaq']));
    }
}
