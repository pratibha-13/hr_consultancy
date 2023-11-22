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
use App\BlogComment;
use App\Category;
use Intervention\Image\ImageManagerStatic as ImageResize;
use App\DataTables\BlogCommentDataTable;
use Str;

class BlogCommentController extends Controller
{
    function __construct()
    {

    }

    public function index(Builder $builder, BlogCommentDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'blog_comment_id', 'name' => 'blog_comment_id','title' => 'ID'],
            ['data' => 'user_name', 'name' => 'user_name','title' => 'User Name'],
            ['data' => 'email', 'name' => 'email','title' => 'Email'],
            ['data' => 'comments', 'name' => 'comments','title' => 'Comment'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);
        if(request()->ajax()) {
            $result = BlogComment::all();
            return $dataTable->dataTable($result)->toJson();
        }
        return view('admin.blogComment.list', compact('html'));
    }
    public function show($id)
    {
            $record = BlogComment::where('blog_id',$id)->first();
            $blog = Blog::select('blog_title')->where('blog_id',$record['blog_id'])->first();

            if(!empty($record)){
            return view('admin.blogComment.view')->with(compact('record','blog'));
        }
        else{
            Session::flash('message', 'Blog Comment not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('blogComment.index');
        }
    }

    public function edit($id)
    {
        $record = BlogComment::find($id);
        $blog = Blog::select('blog_title')->where('blog_id',$record['blog_id'])->first();
        if(!empty($record)){
            return view('admin.blogComment.edit')->with(compact('record','blog'));
        }
        else{
            Session::flash('message', 'Blog Comment not found!');
            Session::flash('alert-class', 'error');
            return redirect()->route('blogComment.index');
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'comments' => 'required',
        );
        $messages = [

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $record = BlogComment::find($request->id);
            if(isset($request['comments']) && $request['comments'] != ''){
                $record->comments = $request['comments'];
            }
            if ($record->save()) {
                Session::flash('message', 'Blog Comment Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect()->route('blogComment.index');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->route('blogComment.index');
            }
        }
    }

    public function destroy($id)
    {
        $delete = BlogComment::find($id);
        if ($delete->delete()) {
            Session::flash('message', 'Blog Comment Deleted !!');
            Session::flash('alert-class', 'warning');
            return true;
        }else{
            return 'Something went to wrong';
        }
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,BlogComment::class,'status');
    }
}
