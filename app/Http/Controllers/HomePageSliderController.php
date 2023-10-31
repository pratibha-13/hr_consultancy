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
            ['data' => 'title', 'name' => 'home_page_slider.title','title' => 'Title'],
            ['data' => 'name', 'name' => 'categories.name','title' => 'Category'],
            ['data' => 'sub_cat_nm', 'name' => 'sub_categories.sub_cat_nm','title' => 'Sub Category'],
            ['data' => 'product_name', 'name' => 'products.product_name','title' => 'Product'],
            ['data' => 'status', 'name' => 'home_page_slider.status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'home_page_slider.created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = HomePageSlider::leftJoin('categories', 'categories.category_id', '=', 'home_page_slider.category')->leftJoin('sub_categories', 'sub_categories.sub_category_id', '=', 'home_page_slider.sub_category')->leftJoin('products', 'products.product_id', '=', 'home_page_slider.product')
            ->select('home_page_slider.*', 'categories.name','sub_categories.name as sub_cat_nm','products.product_name');
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.homePageSlider.list', compact('html'));
    }

    public function create(){
        $category = Category::where('status','1')->get();
        $subCategory = SubCategory::where('status','1')->get();
        $product=Product::where('status','1')->get();
        return view('admin.homePageSlider.create',compact('category','subCategory','product'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'category' => 'required',
            'slider_selection' => 'required',
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
            // $category = implode(",",$request['category']);

            $record = new HomePageSlider();
            $record->title = $request['title'];
            $record->short_description = isset($request['short_description']) ? $request['short_description'] : '';
            $record->category = isset($request['category']) ? $request['category'] : '';
            $record->sub_category = isset($request['sub_category']) ? $request['sub_category'] : '';
            $record->product = isset($request['product']) ? $request['product'] : '';
            $record->slider_selection = isset($request['slider_selection']) ? $request['slider_selection'] : 'main';

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
            $result = HomePageSlider::leftJoin('categories', 'categories.category_id', '=', 'home_page_slider.category')->leftJoin('sub_categories', 'sub_categories.sub_category_id', '=', 'home_page_slider.sub_category')->leftJoin('products', 'products.product_id', '=', 'home_page_slider.product')
            ->select('home_page_slider.*', 'categories.name','sub_categories.name as sub_cat_nm','products.product_name')
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
        $category = Category::select('category_id','name')->where('status','1')->get();
        $subCategory = SubCategory::where('status','1')->get();
        $product = Product::select('products.*')->where('status','1')->get();
        if(!empty($result)){
            return view('admin.homePageSlider.edit')->with(compact('product','category','subCategory','result'));
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
            'category' => 'required',
            'slider_selection' => 'required',
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
            if(isset($request['category']) && $request['category'] != ''){
                $record->category = $request['category'];
            }
            if(isset($request['sub_category'])){
                $record->sub_category = $request['sub_category'];
            }
            if(isset($request['sub_category'])==null){
                $record->sub_category = '';
            }
            if(isset($request['product'])){
                $record->product = $request['product'];
            }
            if(isset($request['product'])==null){
                $record->product = '';
            }
            if(isset($request['slider_selection']) && $request['slider_selection'] != ''){
                $record->slider_selection = $request['slider_selection'];
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
