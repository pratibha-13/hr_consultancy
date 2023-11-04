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
use App\OurTeam;
use Intervention\Image\ImageManagerStatic as ImageResize;
use App\DataTables\OurTeamDataTable;
use Str;

class OurTeamController extends Controller
{
    function __construct()
    {

    }

    public function index(Builder $builder, OurTeamDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'our_team_id', 'name' => 'our_team_id','title' => 'ID'],
            ['data' => 'full_name', 'name' => 'full_name','title' => 'Name'],
            ['data' => 'designation', 'name' => 'designation','title' => 'Designation'],
            ['data' => 'profile', 'name' => 'profile','title' => 'Profile'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = OurTeam::all();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.ourTeam.list', compact('html'));
    }

    public function create(){
        return view('admin.ourTeam.create');
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
            $record = new OurTeam();
            $record->full_name = $request['full_name'];
            $record->designation = $request['designation'];
            if($request->file('image') != null){
            $newImageName="";
            $folderPath = base_path().'/resources/uploads/profile/';
            $file=$request->file('image');
            $newImageName = rand().'_'.$file->getClientOriginalName();
            $file_name = str_replace(" ", "", $newImageName);
            $file->move($folderPath, $file_name);
            $record->profile = $file_name;
            }
            if ($record->save()) {
                Session::flash('message', 'Team Added Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('ourTeam.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('ourTeam.index');
            }
        }
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

    public function edit($id)
    {
        $record = OurTeam::find($id);
        if(!empty($record)){
            return view('admin.ourTeam.edit')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Team not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('ourTeam.index');
        }
    }

    public function update(Request $request)
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
            $record = OurTeam::find($request->id);
            $record->full_name = $request->full_name;
            $record->designation = $request->designation;
            if($request->file('image') != null){
                $uriSegments = explode("/", parse_url($record->profile, PHP_URL_PATH));
                $lastUriSegment = array_pop($uriSegments);
                if($lastUriSegment && file_exists(base_path().'/resources/uploads/profile/'.$lastUriSegment)){
                          unlink(base_path().'/resources/uploads/profile/'.$lastUriSegment); // correct
                    }
                $newImageName="";
                $folderPath = base_path().'/resources/uploads/profile/';
                $file=$request->file('image');
                $newImageName = rand().'_'.$file->getClientOriginalName();
                $file_name = str_replace(" ", "", $newImageName);
                $file->move($folderPath, $file_name);
                $record->profile = $file_name;
                }
            if ($record->save()) {
                Session::flash('message', 'Team Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('ourTeam.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('ourTeam.index');
            }
        }
    }

    public function destroy($id)
    {
        $delete = OurTeam::find($id);
        $uriSegments = explode("/", parse_url($delete->profile, PHP_URL_PATH));
        $lastUriSegment = array_pop($uriSegments);
        if($lastUriSegment && file_exists(base_path().'/resources/uploads/profile/'.$lastUriSegment)){
                  unlink(base_path().'/resources/uploads/profile/'.$lastUriSegment); // correct
                }

        if ($delete->delete()) {
            Session::flash('message', 'Team Deleted !!');
            Session::flash('alert-class', 'warning');
            return true;
        }else{
            return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,OurTeam::class,'status');
    }
}
