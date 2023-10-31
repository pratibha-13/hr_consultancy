<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Validator;
use Image;
use Session;
use File;
use DB;
use URL;
use Auth;
use App\Helper\GlobalHelper;
use App\DataTables\ContactUSDataTable;
use App\User;
use App\ContactUs;

class ContactUSController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:contact-us-message', ['only' => ['index','store']]);
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Builder $builder, ContactUSDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id','title' => 'ID'],
            ['data' => 'name', 'name' => 'name','title' => 'Name'],
            ['data' => 'email', 'name' => 'email','title' => 'Email'],
            ['data' => 'phone_number', 'name' => 'phone_number','title' => 'Phone Number'],
            ['data' => 'subject', 'name' => 'subject','title' => 'Subject'],
            ['data' => 'description', 'name' => 'description','title' => 'Description'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Created On'],
        ])->parameters([
            'order' => [0,'desc'],
            'scrollX' => 'true',
            'stateSave' => true,
        ]);
        if(request()->ajax()) {
            $result = ContactUs::select();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.contactUs.list', compact(['html']));
    }
}