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
use App\Service;
use App\DataTables\ServiceDataTable;
use Str;

class ServiceController extends Controller
{
    function __construct()
    {

    }

    public function index(Builder $builder, ServiceDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'service_id', 'name' => 'service_id','title' => 'ID'],
            ['data' => 'title', 'name' => 'title','title' => 'Title'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = Service::all();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.service.list', compact('html'));
    }

    public function create(){
        return view('admin.service.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required',
        );
        $messages = [
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = new Service();
            $record->title = $request['title'];
            $record->description = $request['description'];
            $record->icon = $request['icon'];

            if ($record->save()) {
                Session::flash('message', 'Service Added Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('service.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('service.index');
            }
        }
    }

    public function show($id)
    {
            $record = Service::where('service_id',$id)
            ->first();

            if(!empty($record)){
            return view('admin.service.view')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Service not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('service.index');
        }
    }

    public function edit($id)
    {
        $record = Service::find($id);
        if(!empty($record)){
            return view('admin.service.edit')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Service not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('service.index');
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required',
        );
        $messages = [

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = Service::find($request->id);

            if(isset($request['title']) && $request['title'] != ''){
                $record->title = $request['title'];
            }
            if(isset($request['description']) && $request['description'] != ''){
                $record->description = $request['description'];
            }
            if(isset($request['icon']) && $request['icon'] != ''){
                $record->icon = $request['icon'];
            }

            if ($record->save()) {
                Session::flash('message', 'Service Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('service.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('service.index');
            }
        }
    }

    public function destroy($id)
    {
        $delete = Service::find($id);
        if ($delete->delete()) {
            Session::flash('message', 'Service Deleted !!');
            Session::flash('alert-class', 'warning');
            return true;
        }else{
            return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Service::class,'status');
    }
}
