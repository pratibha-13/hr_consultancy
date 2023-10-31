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
use App\Helper\GlobalHelper;
use Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Country;
use App\State;
use App\City;
use App\Notification;
use App\DataTables\NotificationDataTable;
use Yajra\DataTables\Html\Builder;

class NotificationController extends Controller
{
  function __construct()
  {
      $this->middleware('permission:notification-list|notification-create|notification-edit|notification-delete|notification-status-change|notification-view', ['only' => ['index','store']]);
      $this->middleware('permission:notification-create', ['only' => ['create','store']]);
      $this->middleware('permission:notification-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:notification-delete', ['only' => ['destroy']]);
      $this->middleware('permission:notification-status-change', ['only' => ['changeStatus']]);
      $this->middleware('permission:notification-view', ['only' => ['show']]);
  }
  public function index(Builder $builder, NotificationDataTable $dataTable)
  {
    $html = $builder->columns([
      ['data' => 'id', 'name' => 'id','title' => 'ID'],
      ['data' => 'full_name', 'name' => 'userDetail.full_name','title' => 'Name'],
      ['data' => 'title', 'name' => 'title','title' => 'Title'],
      ['data' => 'message', 'name' => 'message','title' => 'Message'],
      ['data' => 'created_at', 'name' => 'created_at','title' => 'Created On'],
    ])->parameters([
        'order' => [0,'desc'],
        'scrollX' => 'true',
        'stateSave' => true,
    ]);
    if(request()->ajax()) {
        $result = Notification::with('userDetail')->select();
        return $dataTable->dataTable($result)->toJson();
    }
    return view('admin.notification.list', compact(['html']));
  }
  public function create(){
      $users = User::whereHas('roles', function($q){$q->where('name','user');})->where('user_status','=','1')->get();
      return view('admin.notification.add',compact(['users']));
  }
  
  public function store(Request $request){
    $rules = array(
        'user_id' => 'required',
        'title' => 'required',
        'message' => 'required',
    );
    $messages = [
    ];

    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return redirect()->back()
                      ->withErrors($validator)
                      ->withInput();
    } else {
      if (in_array("all", $request->user_id)){
        $user = User::getAllUsers();
      }else{
        $user = User::whereIn('id', $request->user_id)->get();
      }
      foreach ($user as $key => $value) {
        $notification = new Notification();
        $notification->user_id = $value->id;
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->notification_type = '2';
        $notification->save();
        $title = $request->title;
        $message = $request->message;
        $notification_type = '2';
        if($value->device_token != ''){
          if($value->device_token){
              if($value->device_type == 1){ // IOS
                  $app_type = $value->device_app_type?$value->device_app_type:env('APP_TYPE');
                  GlobalHelper::sendGCM($title, $message,$value->device_token,$app_type,$notification_type,$notification);
              }elseif($value->device_type == 2){ // Android
                  GlobalHelper::sendFCM($title, $message,$value->device_token,$notification_type,$notification);
              }
          }
        }
      }
      Session::flash('message', 'Notification sent successfully !');
      Session::flash('alert-class', 'success');
      return redirect()->route('notification.index');
    }
  }
}
