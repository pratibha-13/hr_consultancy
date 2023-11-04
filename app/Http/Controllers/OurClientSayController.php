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
use App\OurClientSay;
use Intervention\Image\ImageManagerStatic as ImageResize;
use App\DataTables\OurClientSayDataTable;
use Str;

class OurClientSayController extends Controller
{
    function __construct()
    {

    }

    public function index(Builder $builder, OurClientSayDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'our_client_say_id', 'name' => 'our_client_say_id','title' => 'ID'],
            ['data' => 'our_client_say_name', 'name' => 'our_client_say_name','title' => 'Name'],
            ['data' => 'profession', 'name' => 'profession','title' => 'Profession'],
            ['data' => 'our_client_say_description', 'name' => 'our_client_say_description','title' => 'Description'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = OurClientSay::all();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.ourClientSay.list', compact('html'));
    }

    public function create(){
        return view('admin.ourClientSay.create');
    }

    public function store(Request $request)
    {
        $rules = array(

        );
        $messages = [
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = new OurClientSay();
            $record->our_client_say_name = $request['our_client_say_name'];
            $record->profession = $request['profession'];
            $record->our_client_say_description = $request['our_client_say_description'];

        if($request->file('image') != null){
        $newImageName="";
        $folderPath = base_path().'/resources/uploads/profile/';
        $file=$request->file('image');
        $newImageName = rand().'_'.$file->getClientOriginalName();
        $file_name = str_replace(" ", "", $newImageName);
        $file->move($folderPath, $file_name);
        $record->our_client_say_profile = $file_name;
        }
            if ($record->save()) {
                Session::flash('message', 'Our Client Say Added Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('ourClientSay.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('ourClientSay.index');
            }
        }
    }

    public function show($id)
    {
            $record = OurClientSay::where('our_client_say_id',$id)
            ->first();

            if(!empty($record)){
            return view('admin.ourClientSay.view')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Our Client Say not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('ourClientSay.index');
        }
    }

    public function edit($id)
    {
        $record = OurClientSay::find($id);
        if(!empty($record)){
            return view('admin.ourClientSay.edit')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Our Client Say not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('ourClientSay.index');
        }
    }

    // public function update(Request $request)
    // {
    //     $rules = array(

    //     );
    //     $messages = [

    //     ];

    //     $validator = Validator::make($request->all(), $rules, $messages);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //                         ->withErrors($validator)
    //                         ->withInput();
    //     } else {
    //         $record = OurClientSay::find($request->id);
    //         $record->our_client_say_name = $request->our_client_say_name;
    //         $record->our_client_say_city = $request->our_client_say_city;
    //         $record->our_client_say_description = $request->our_client_say_description;

    //         if($request->file('image') != null){
    //             $uriSegments = explode("/", parse_url($record->product_image, PHP_URL_PATH));
    //             $lastUriSegment = array_pop($uriSegments);
    //             if($lastUriSegment && file_exists(base_path().'/resources/uploads/profile/'.$lastUriSegment)){
    //                       unlink(base_path().'/resources/uploads/profile/'.$lastUriSegment); // correct
    //                 }
    //             $newImageName="";
    //             $folderPath = base_path().'/resources/uploads/profile/';
    //             $file=$request->file('image');
    //             $newImageName = rand().'_'.$file->getClientOriginalName();
    //             $file_name = str_replace(" ", "", $newImageName);
    //             $file->move($folderPath, $file_name);
    //             $record->our_client_say_profile = $file_name;
    //             }
    //         if ($record->save()) {
    //             Session::flash('message', 'Our Updated Succesfully !');
    //             Session::flash('alert-class', 'success');
    //             return redirect()->route('product.index');
    //         } else {
    //             Session::flash('message', 'Oops !! Something went wrong!');
    //             Session::flash('alert-class', 'error');
    //             return redirect()->route('product.index');
    //         }
    //     }
    // }

    public function destroy($id)
    {
        $delete = OurClientSay::find($id);
        $uriSegments = explode("/", parse_url($delete->our_client_say_profile, PHP_URL_PATH));
        $lastUriSegment = array_pop($uriSegments);
        if($lastUriSegment && file_exists(base_path().'/resources/uploads/profile/'.$lastUriSegment)){
                  unlink(base_path().'/resources/uploads/profile/'.$lastUriSegment); // correct
                }

        if ($delete->delete()) {
            Session::flash('message', 'Our Client Say Deleted !!');
            Session::flash('alert-class', 'warning');
            return true;
        }else{
            return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,OurClientSay::class,'status');
    }
}
