<?php

namespace App\Http\Controllers\Admin;

use App\User;
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
use App\Country;
use App\State;
use App\City;
use App\Banner;
use Intervention\Image\ImageManagerStatic as ImageResize;
use App\DataTables\BannerDataTable;
use Str;

class BannerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete|banner-status-change|banner-view', ['only' => ['index','store']]);
        $this->middleware('permission:banner-create', ['only' => ['create','store']]);
        $this->middleware('permission:banner-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:banner-delete', ['only' => ['destroy']]);
        $this->middleware('permission:banner-status-change', ['only' => ['changeStatus']]);
        $this->middleware('permission:banner-view', ['only' => ['show']]);
    }
    
    public function index(Builder $builder, BannerDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'banner_id', 'name' => 'banner_id','title' => 'ID'],
            ['data' => 'title', 'name' => 'title','title' => 'Title'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ]);
        $record = Banner::all();
        if(request()->ajax()) {
            return $dataTable->dataTable($record)->toJson();
        }
        return view('admin.Banner.list',compact('html'));
    }

    public function create(){
        return view('admin.Banner.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'link' => 'required',
            'banner_description' => 'required',
        );
        $messages = [
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = new Banner();
            $record->title = $request['title'];
            $record->banner_description = $request['banner_description'];
            $record->link = $request['link'];

             if(!empty($request['main_image']) || $request['main_image'] != ''){
                $data = explode(';', $request['main_image']);
                $part = explode("/", $data[0]);
                $image = $request['main_image'];  // your base64 encoded
                $image = str_replace('data:image/'.$part[1].';base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $fileName = md5(microtime().Str::random(10)) .'.'.$part[1];
                $destinationPath = base_path().'/resources/uploads/banner/';
                \File::put(base_path().'/resources/uploads/banner/' .$fileName, base64_decode($image));
                chmod($destinationPath.$fileName,0777);
                $record->image = $fileName;
            }

            if ($record->save()) {
                Session::flash('message', 'Banner Added Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('banner.index');


            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('banner.index');
            }
        }
    }

    public function show($id)
    {
        $record = Banner::find($id);
        if(!empty($record)){
            return view('admin.Banner.view')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Banner not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('banner.index');
        }
    }

    public function edit($id)
    {
        $record = Banner::find($id);
        if(!empty($record)){
            return view('admin.Banner.edit')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Banner not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('banner.index');
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'link' => 'required',
            'banner_description' => 'required',
        );
        $messages = [
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = Banner::find($request->banner_id);
            $record->title = $request->title;
            $record->banner_description = $request->banner_description;
            $record->link = $request->link;

             if(!empty($request->main_image) || $request->main_image != ''){
                if($record->image != $request->main_image) {
                    if($record->getOriginal('image') && file_exists(base_path().'/resources/uploads/banner/'.$record->getOriginal('image'))){
                        unlink(base_path().'/resources/uploads/banner/'.$record->getOriginal('image')); // correct
                    }
                    $data = explode(';', $request->main_image);
                    $part = explode("/", $data[0]);
                    $image = $request->main_image;  // your base64 encoded
                    $image = str_replace('data:image/'.$part[1].';base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $fileName = md5(microtime().Str::random(10)) .'.'.$part[1];
                    $destinationPath = base_path().'/resources/uploads/banner/';
                    \File::put(base_path().'/resources/uploads/banner/' .$fileName, base64_decode($image));
                    chmod($destinationPath.$fileName,0777);
                    $record->image = $fileName;
                    $image = url('/').'/resources/uploads/banner/'.$fileName;
                }
            }
            if ($record->save()) {
                Session::flash('message', ' Banner Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('banner.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('banner.index');
            }
        }
    }

    public function destroy($id)
    {
        $delete = Banner::find($id);
        if ($delete->delete()) {
            Session::flash('message', 'Banner Deleted !!');
            Session::flash('alert-class', 'warning');
            return true;
        }else{
            return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Banner::class,'status');
    }
}
