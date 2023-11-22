<?php

namespace App\Http\Controllers;

use App\Product;
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
use App\Category;
use App\SubCategory;
use App\Color;
use App\Size;
use App\HomePageSlider;
use Intervention\Image\ImageManagerStatic as ImageResize;
use App\DataTables\HomePageSliderDataTable;
use Str;

class HomePageSliderController extends Controller
{
    function __construct()
    {

    }

    public function index(Builder $builder, HomePageSliderDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'home_page_slider_id', 'name' => 'home_page_slider.home_page_slider_id','title' => 'ID'],
            ['data' => 'short_description', 'name' => 'home_page_slider.short_description','title' => 'Short Headline'],
            ['data' => 'title', 'name' => 'home_page_slider.title','title' => 'Title'],
            ['data' => 'status', 'name' => 'home_page_slider.status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'home_page_slider.created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = HomePageSlider::select('home_page_slider.*')->get();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.homePageSlider.list', compact('html'));
    }

    public function create(){
        return view('admin.homePageSlider.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'image' => 'required',
        );
        $messages = [
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = new HomePageSlider();
            $record->title = $request['title'];
            $record->short_description = isset($request['short_description']) ? $request['short_description'] : '';
            if($request->file('image') != null){
                $newImageName="";
                $folderPath = base_path().'/resources/uploads/sliderImage/';
                $file=$request->file('image');
                $newImageName = rand().'_'.$file->getClientOriginalName();
                $file_name = str_replace(" ", "", $newImageName);
                $file->move($folderPath, $file_name);
                $record->image = $file_name;
                }

            if ($record->save()) {
                Session::flash('message', 'Home Page Slider Added Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('homePageSlider.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('homePageSlider.index');
            }
        }
    }

    public function show($id)
    {
            $result = HomePageSlider::select('home_page_slider.*')
            ->where('home_page_slider.home_page_slider_id',$id)
            ->first();

            if(!empty($result)){
            return view('admin.homePageSlider.view')->with(compact('result'));
        }
        else{
            Session::flash('message', 'Slider not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('homePageSlider.index');
        }
    }

    public function edit($id)
    {
        $result = HomePageSlider::find($id);
        if(!empty($result)){
            return view('admin.homePageSlider.edit')->with(compact('result'));
        }
        else{
            Session::flash('message', 'Slider not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('homePageSlider.index');
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'title' => 'required',
        );
        $messages = [

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = HomePageSlider::find($request->id);
            if(isset($request['title'])){
                $record->title = $request['title'];
            }
            if(isset($request['title'])==null){
                $record->title = '';
            }

            if(isset($request['short_description'])){
                $record->short_description = $request['short_description'];
            }
            if(isset($request['short_description'])==null){
                $record->short_description ='';
            }
            if(isset($request['short_description']) && $request['short_description'] != ''){
                $record->short_description = $request['short_description'];
            }
            if($request->file('image') != null){
                $uriSegments = explode("/", parse_url($record->image, PHP_URL_PATH));
                $lastUriSegment = array_pop($uriSegments);
                if($lastUriSegment && file_exists(base_path().'/resources/uploads/sliderImage/'.$lastUriSegment)){
                          unlink(base_path().'/resources/uploads/sliderImage/'.$lastUriSegment); // correct
                    }
                $newImageName="";
                $folderPath = base_path().'/resources/uploads/sliderImage/';
                $file=$request->file('image');
                $newImageName = rand().'_'.$file->getClientOriginalName();
                $file_name = str_replace(" ", "", $newImageName);
                $file->move($folderPath, $file_name);
                $record->image = $file_name;
                }

            if ($record->save()) {
                Session::flash('message', 'Slider Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('homePageSlider.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('homePageSlider.index');
            }
        }
    }

    public function destroy($id)
    {
        $delete = HomePageSlider::find($id);
        $uriSegments = explode("/", parse_url($delete->image, PHP_URL_PATH));
        $lastUriSegment = array_pop($uriSegments);
        if($lastUriSegment && file_exists(base_path().'/resources/uploads/sliderImage/'.$lastUriSegment)){
                  unlink(base_path().'/resources/uploads/sliderImage/'.$lastUriSegment); // correct
                }

        if ($delete->delete()) {
            Session::flash('message', 'Slider Deleted !!');
            Session::flash('alert-class', 'warning');
            return true;
        }else{
            return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,HomePageSlider::class,'status');
    }
}
