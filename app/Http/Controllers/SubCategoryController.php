<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\Html\Builder;
use App\DataTables\SubCategoryDataTable;
use App\SubCategory;
use App\Category;
use DB;
use Session;
use Validator;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, SubCategoryDataTable $dataTable)
    {
        $html = $builder->columns([
            ['data' => 'sub_category_id', 'name' => 'sub_category_id','title' => 'ID'],
            ['data' => 'category', 'category' => 'name','title' => 'Category'],
            ['data' => 'name', 'name' => 'name','title' => 'Name'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'is_header_show', 'name' => 'is_header_show','title' => 'Header Show'],
            ['data' => 'is_footer_show', 'name' => 'is_footer_show','title' => 'Footer Show'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "order"=> [[ 0, "desc" ]],
          ]);

        if(request()->ajax()) {
            $sub_categories = SubCategory::all();
            /*whereHas('category', function($query) {
                $query->where('categories.status', '=', '1');
            })
            ->where('sub_categories.status', '=', '1');*/
            return $dataTable->dataTable($sub_categories)->toJson();
        }

        //get list of all categories
        $categories = Category::where('status','1')->get();//where('status','1')->get();
        return view('admin.sub_categories.list', compact('html', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryID=$request->category_id;
        $rules = [
            // 'name' => 'required|min:2|max:40',
            'name' =>
            [ 'required',
            Rule::unique('sub_categories')->where(function ($query) use ($categoryID)
            {
              $query->where('category_id',$categoryID);
            }),
          ],
            'category_id' => 'required|exists:categories,category_id'
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $sub_category = new SubCategory();
            $sub_category->name = $request->name;
            $sub_category->category_id = $request->category_id;
            $sub_category->is_header_show =isset($request['is_header_show']) && !empty($request['is_header_show']) ? $request['is_header_show'] : '1';
            $sub_category->is_footer_show =isset($request['is_footer_show']) && !empty($request['is_footer_show']) ? $request['is_footer_show'] : '1';
            if($sub_category->save()) {
                Session::flash('message', 'SubCategory added succesfully!');
                Session::flash('alert-class', 'success');
                return redirect()->back();
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->back();
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_category = SubCategory::findOrfail($id);

        //get list of all categories
        $categories = Category::where('status','1')->get();

        return view('admin.sub_categories.view', compact('sub_category', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $sub_category = SubCategory::findOrfail($id);
        //get list of all categories
        $categories = Category::where('status','1')->get();
        return view('admin.sub_categories.edit', compact('sub_category', 'categories'));
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
        $sid=$request->category_id;
        // $id=$request->id;
        $rules = [
            // 'name' => 'required|min:2|max:40',
            'name' =>
            [
            Rule::unique('sub_categories')->where(function ($query) use ($id,$sid)
            {
              $query->where('sub_category_id','<>',$id)->where('category_id',$sid);
            }),
          ],
            'category_id' => 'required|exists:categories,category_id'
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $sub_category = SubCategory::find($id);
            if(isset($request['name']) && $request['name'] != ''){
                $sub_category->name = $request['name'];
              }
              if(isset($request['category_id']) && $request['category_id'] != ''){
                $sub_category->category_id = $request['category_id'];
              }
              if(isset($request['is_header_show']) && $request['is_header_show'] != ''){
                $sub_category->is_header_show = $request['is_header_show'];
              }
            if(isset($request['is_footer_show']) && $request['is_footer_show'] != ''){
              $sub_category->is_footer_show = $request['is_footer_show'];
              }'1';
            if($sub_category->save()) {
                Session::flash('message', 'SubCategory updated succesfully!');
                Session::flash('alert-class', 'success');
                return redirect('admin/sub-categories');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::destroy($id);
        if($subcategory)
            return true;
        else
            return 'Something went to wrong!';
    }
    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,SubCategory::class,'status');
    }
}
