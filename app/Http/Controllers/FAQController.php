<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\DataTables\FAQDataTable;
use App\FAQ;
use Session;
use Validator;
use DataTables;
class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, FAQDataTable $dataTable)
    {

        $html = $builder->columns([
            ['data' => 'faq_id', 'name' => 'faq_id','title' => 'ID'],
            ['data' => 'type', 'name' => 'type','title' => 'Type'],
            ['data' => 'question', 'name' => 'question','title' => 'Title'],
            ['data' => 'answer', 'name' => 'answer','title' => 'Answer'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ])
        ->parameters([
            "scrollX" => true,
            "stateSave" => true,
            "order" =>["0","DESC"]
        ]);

        if(request()->ajax()) {
            $faqs = FAQ::all();//where('status','1');
            return $dataTable->dataTable($faqs)->toJson();
        }

        return view('admin.faq.list', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['action'  => 'Create','url'=>'admin/faq/','method'   => 'POST'];
        return View('admin.faq.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'question' => 'required',
            'answer'=> 'required',
            'type'=> 'required'
        );
        $messages = [
            'question.required'=>'Question should not be blank',
            'answer.required'=>'Answer should not be blank',
            'type.required'=>'Type should not be blank'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $faq = new FAQ();
            $faq->question = $request['question'];
            $faq->answer = $request['answer'];
            $faq->type = $request['type'];
            
            if ($faq->save()) {
                Session::flash('message', 'FAQ Added Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('admin/faq');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('admin/faq');
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
        $faq = FAQ::find($id);
        $data = ['faq'=>$faq, 'action'  => 'Update','url'=>'admin/faq/'.$id,'method'   => 'PUT'];
        return View('admin.faq.edit')->with($data);
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
            'faq_id'=>'required',
            'question' => 'required',
            'answer'=> 'required',
            'type'=> 'required',
        ];
        $messages = [
            'faq_id.required'=>'Record Not Found',
            'question.required'=>'Question should not be blank',
            'answer.required'=>'Answer should not be blank'
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        } else {

            $faq = FAQ::find($request->faq_id);
            $faq->question = $request['question'];
            $faq->answer = $request['answer'];
            $faq->type = $request['type'];
            $faq->updated_at = date("Y-m-d H:i:s");

            if ($faq->save()) {
                Session::flash('message', 'FAQ Updated Succesfully !');
                Session::flash('alert-class', 'success');
                return redirect('admin/faq');
            } else {
                Session::flash('message', 'Oops !! Something went wrong!');
                Session::flash('alert-class', 'error');
                return redirect('admin/faq');
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
        if(isset($id)){
            $page = FAQ::find($id);
            if($page->delete())
                 return true;
             else
                return 'Something went to wrong';

        }
    }
}
