<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Image;
use Session;
use File;
use DB;
use URL;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Helper\GlobalHelper;
use Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Notifications\UserRegistration;
use App\FreeQuote;
use Intervention\Image\ImageManagerStatic as ImageResize;
use App\DataTables\FreeQuoteDataTable;
use Str;

class FreeQuoteController extends Controller
{
    function __construct()
    {

    }

    public function index(Builder $builder, FreeQuoteDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'free_quote_id', 'name' => 'free_quote_id','title' => 'ID'],
            ['data' => 'full_company_name', 'name' => 'full_company_name','title' => 'Name'],
            ['data' => 'email', 'name' => 'email','title' => 'Email'],
            ['data' => 'contact_number', 'name' => 'contact_number','title' => 'Contact Number'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At']
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = FreeQuote::all();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.freeQuote.list', compact('html'));
    }

    public function show($id)
    {
            $record = OurTeam::where('our_team_id',$id)
            ->first();

            if(!empty($record)){
            return view('admin.ourTeam.view')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Team not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('ourTeam.index');
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,OurTeam::class,'status');
    }
}
