<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\HeaderFooterSettingsDataTable;
use Yajra\DataTables\Html\Builder;
use App\Helper\GlobalHelper;
use Auth;
use Str;
use Session;
use Validator;
use App\HeaderFooterSettings;

class HeaderFooterSettingsController extends Controller
{
    function __construct()
    {

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, HeaderFooterSettingsDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id','title' => 'ID'],
            ['data' => 'address', 'name' => 'address','title' => 'Address'],
            ['data' => 'contact_number', 'name' => 'contact_number','title' => 'Contact Number'],
            ['data' => 'email', 'name' => 'email','title' => 'Email'],
            ['data' => 'facebook_link', 'name' => 'facebook_link','title' => 'Facebook'],
            ['data' => 'google_link', 'name' => 'google_link','title' => 'Google'],
            ['data' => 'twitter_link', 'name' => 'twitter_link','title' => 'Twitter'],
            ['data' => 'instagram_link', 'name' => 'instagram_link','title' => 'Instagram'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order" => [[0, "desc"]]
          ]);


        $users = HeaderFooterSettings::all();
    //    dd($users);

        if(request()->ajax()) {
            return $dataTable->dataTable($users)->toJson();
        }


        return view('admin.headerFooter.list',compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.headerFooter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $rules = array(

    //     );
    //     $messages = [

    //     ];

    //     $validator = Validator::make($request->all(), $rules, $messages);
    //     //dd($validator->fails());
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //                         ->withErrors($validator)
    //                         ->withInput();
    //     } else {
    //         $adminUser = new HeaderFooterSettings();
    //         $adminUser->address = $request['address'];
    //         $adminUser->contact_number = $request['contact_number'];
    //         $adminUser->email = $request['email'];
    //         $adminUser->facebook_link = $request['facebook_link'];
    //         $adminUser->google_link = $request['google_link'];
    //         $adminUser->twitter_link = $request['twitter_link'];
    //         $adminUser->instagram_link = $request['instagram_link'];
    //         $adminUser->footer_description = $request['footer_description'];
    //         $adminUser->order_placed_page_text = $request['footer_description'];
    //         }
    //         if ($adminUser->save()) {
    //             Session::flash('message', 'Added Succesfully !');
    //             Session::flash('alert-class', 'success');
    //             return redirect('admin/header_footer');

    //         } else {
    //             Session::flash('message', 'Oops !! Something went wrong!');
    //             Session::flash('alert-class', 'error');
    //             return redirect('admin/header_footer');
    //         }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = HeaderFooterSettings::find($id);
        if(!empty($user)){

            return view('admin.headerFooter.view')->with(compact('user'));
        }

        else{
            Session::flash('message', 'not found!');
            Session::flash('alert-class', 'error');
            return redirect('admin/header_footer');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = HeaderFooterSettings::find($id);
        if(!empty($user)){
            return view('admin.headerFooter.edit')->with(compact('user'));
        }
        else{
            Session::flash('message', 'not found!');
            Session::flash('alert-class', 'error');
            return redirect('admin/header_footer');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

            $adminUser = HeaderFooterSettings::find($id);
           if(isset($request['address']) && $request['address'] != ''){
                $adminUser->address = $request['address'];
            }
            if(isset($request['latitude']) && $request['latitude'] != ''){
                $adminUser->latitude = $request['latitude'];
            }
            if(isset($request['longitude']) && $request['longitude'] != ''){
                $adminUser->longitude = $request['longitude'];
            }
            if(isset($request['contact_number']) && $request['contact_number'] != ''){
                $adminUser->contact_number = $request['contact_number'];
            }
            if(isset($request['email']) && $request['email'] != ''){
                $adminUser->email = $request['email'];
            }
            if(isset($request['facebook_link']) && $request['facebook_link'] != ''){
                $adminUser->facebook_link = $request['facebook_link'];
            }
            if(isset($request['google_link']) && $request['google_link'] != ''){
                $adminUser->google_link = $request['google_link'];
            }
            if(isset($request['twitter_link']) && $request['twitter_link'] != ''){
                $adminUser->twitter_link = $request['twitter_link'];
            }
            if(isset($request['instagram_link']) && $request['instagram_link'] != ''){
                $adminUser->instagram_link = $request['instagram_link'];
            }
            if(isset($request['footer_description']) && $request['footer_description'] != ''){
                $adminUser->footer_description = $request['footer_description'];
            }
            if(isset($request['order_placed_page_text']) && $request['order_placed_page_text'] != ''){
                $adminUser->order_placed_page_text = $request['order_placed_page_text'];
            }


            if ($adminUser->save()) {
                Session::flash('message', 'Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('admin/header_footer');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('admin/header_footer');
            }
        }
    }
}
