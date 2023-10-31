<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\Html\Builder;
use App\DataTables\CategoryDataTable;
use App\Category;
use App\SubCategory;
use App\Color;
use App\Size;
use DB;
use Session;
use Validator;

class CategoryController extends Controller
{
    function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, CategoryDataTable $dataTable)
    {
       $html = $builder->columns([
            ['data' => 'category_id', 'name' => 'category_id','title' => 'ID'],
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
            $users = Category::all();//where('status','1');
            //dd($users);
            return $dataTable->dataTable($users)->toJson();
        }

        return view('admin.categories.list', compact('html'));
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
        $rules = [
            'name' => 'required|min:2|max:40'
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $category = new Category();
            $category->name = $request->name;
            $category->is_header_show = isset($request['is_header_show']) ? $request['is_header_show'] : '1';
            $category->is_footer_show =isset($request['is_footer_show']) && !empty($request['is_footer_show']) ? $request['is_footer_show'] : '1';
            if($category->save()) {
                Session::flash('message', 'Category added succesfully!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return view('admin.categories.edit', compact('category'));
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
        $rules = [
            'name' => 'required|min:2|max:40'
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $category = Category::find($id);
            if(isset($request['name']) && $request['name'] != ''){
              $category->name = $request['name'];
            }
            if(isset($request['is_header_show']) && $request['is_header_show'] != ''){
              $category->is_header_show = $request['is_header_show'];
          }
          if(isset($request['is_footer_show']) && $request['is_footer_show'] != ''){
            $category->is_footer_show = $request['is_footer_show'];
        }
            if($category->save()) {
                Session::flash('message', 'Category updated succesfully!');
                Session::flash('alert-class', 'success');
                return redirect('admin/categories');
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
    public function destroy($categoty_id)
    {
        $category = Category::destroy($categoty_id);
        if($category)
            return true;
        else
            return 'Something went to wrong!';
    }
    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Category::class,'status');
    }

    public function getSubCategory(Request $request){
        $subCategory = new SubCategory();
        $subCategorys = $subCategory->getSubCategory($request->id);
        $option = '<option></option>';
        if(isset($request->sub_category) && !is_null($request->sub_category)) {
          foreach($subCategorys as $subCategory) {
            $option .= '<option value="'.$subCategory['sub_category_id'].'" '.(($request->sub_category == $subCategory['sub_category_id']) ? 'selected': '').'>'.$subCategory['name'].'</option>';
          }
        } else {
          foreach($subCategorys as $subCategory) {
            $option .= '<option value="'.$subCategory['sub_category_id'].'">'.$subCategory['name'].'</option>';
          }
        }

        echo $option;
      }
      public function getsize(Request $request){
        $size = new Size();
        $sizes = $size->getsize($request->id);
        $option = '<option></option>';
        if(isset($request->size) && !is_null($request->size)) {
          foreach($sizes as $size) {
            $option .= '<option value="'.$size['size_id'].'" '.(($request->size == $size['size_id']) ? 'selected': '').'>'.$size['size_name'].'</option>';
          }
        } else {
          foreach($sizes as $size) {
            $option .= '<option value="'.$size['size_id'].'">'.$size['size_name'].'</option>';
          }
        }

        echo $option;
      }
      public function getcolor(Request $request){
        $color = new Color();
        $colors = $color->getcolor($request->id);
        $option = '<option></option>';
        if(isset($request->color) && !is_null($request->color)) {
          foreach($colors as $color) {
            $option .= '<option value="'.$color['color_id'].'" '.(($request->color == $color['color_id']) ? 'selected': '').'>'.$color['color_name'].'</option>';
          }
        } else {
          foreach($colors as $color) {
            $option .= '<option value="'.$color['color_id'].'">'.$color['color_name'].'</option>';
          }
        }

        echo $option;
      }
}
