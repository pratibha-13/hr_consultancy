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
use App\Blog;
use App\Category;
use Intervention\Image\ImageManagerStatic as ImageResize;
use App\DataTables\BlogDataTable;
use Str;

class BlogController extends Controller
{
    function __construct()
    {

    }

    public function index(Builder $builder, BlogDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'blog_id', 'name' => 'blog_id','title' => 'ID'],
            ['data' => 'blog_created', 'name' => 'blog_created','title' => 'Name'],
            ['data' => 'category', 'name' => 'category','title' => 'Category'],
            ['data' => 'blog_title', 'name' => 'blog_title','title' => 'Blog Title'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = Blog::all();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.blog.list', compact('html'));
    }

    public function create(){
        $category = Category::where('status','1')->get();
        return view('admin.blog.create',compact('category'));
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
            $record = new Blog();
            $record->blog_created = 'ADMIN';
            $record->category_id = $request['category'];
            if($request['category'] != null )
            {
                $categoryName=Category::where('category_id',$request['category'])->first();
                $record->category = $categoryName['name'];
            }
            $record->blog_title = $request['blog_title'];
            $record->blog_description = $request['blog_description'];
            if($request->file('image') != null){
            $newImageName="";
            $folderPath = base_path().'/resources/uploads/blog_image/';
            $file=$request->file('image');
            $newImageName = rand().'_'.$file->getClientOriginalName();
            $file_name = str_replace(" ", "", $newImageName);
            $file->move($folderPath, $file_name);
            $record->blog_image = $file_name;
            }
            if ($record->save()) {
                Session::flash('message', 'Blog Added Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('blog.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('blog.index');
            }
        }
    }

    public function show($id)
    {
            $record = Blog::where('blog_id',$id)
            ->first();

            if(!empty($record)){
            return view('admin.blog.view')->with(compact('record'));
        }
        else{
            Session::flash('message', 'Blog not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('blog.index');
        }
    }

    public function edit($id)
    {
        $record = Blog::find($id);
        $category = Category::select('category_id','name')->where('status','1')->get();
        if(!empty($record)){
            return view('admin.blog.edit')->with(compact('record','category'));
        }
        else{
            Session::flash('message', 'Blog not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('blog.index');
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
            $record = Blog::find($request->id);
            if(isset($request['category']) && $request['category'] != ''){
                $record->category_id = $request['category'];
            }
            if($request['category'])
            {
                $categoryName=Category::where('category_id',$request['category'])->first();
                $record->category = $categoryName['category'];
            }
            if(isset($request['blog_title']) && $request['blog_title'] != ''){
                $record->blog_title = $request['blog_title'];
            }
            if(isset($request['blog_description']) && $request['blog_description'] != ''){
                $record->blog_description = $request['blog_description'];
            }
            if($request->file('image') != null){
                $uriSegments = explode("/", parse_url($record->blog_image, PHP_URL_PATH));
                $lastUriSegment = array_pop($uriSegments);
                if($lastUriSegment && file_exists(base_path().'/resources/uploads/blog_image/'.$lastUriSegment)){
                          unlink(base_path().'/resources/uploads/blog_image/'.$lastUriSegment); // correct
                    }
                $newImageName="";
                $folderPath = base_path().'/resources/uploads/blog_image/';
                $file=$request->file('image');
                $newImageName = rand().'_'.$file->getClientOriginalName();
                $file_name = str_replace(" ", "", $newImageName);
                $file->move($folderPath, $file_name);
                $record->blog_image = $file_name;
                }
            if ($record->save()) {
                Session::flash('message', 'Blog Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('blog.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('blog.index');
            }
        }
    }

    public function destroy($id)
    {
        $delete = Blog::find($id);
        $uriSegments = explode("/", parse_url($delete->blog_image, PHP_URL_PATH));
        $lastUriSegment = array_pop($uriSegments);
        if($lastUriSegment && file_exists(base_path().'/resources/uploads/blog_image/'.$lastUriSegment)){
                  unlink(base_path().'/resources/uploads/blog_image/'.$lastUriSegment); // correct
                }

        if ($delete->delete()) {
            Session::flash('message', 'Blog Deleted !!');
            Session::flash('alert-class', 'warning');
            return true;
        }else{
            return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Blog::class,'status');
    }
}
