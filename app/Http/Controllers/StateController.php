<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\DataTables\CityDataTable;
use App\Country;
use App\State;
use App\City;
use DataTables;
use Validator;
use Session;
use DB;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       // dd($request->input());
        $rules = [
            'state_name' => 'required',
            'state_country' => 'required|exists:countries,country_id'
        ];

        $messages = [
            'state_country.required' => 'Please select a Country.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $state = new State;
            $state->name = $request->state_name;
            $state->country_id = $request->state_country;
            $state->status = '1';
            if ($state->save()) {
              Session::flash('message', 'State Added Succesfully !');
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
    public function show(Builder $builder, CityDataTable $dataTable,$id)
    {
       $html = $builder->columns([
            ['data' => 'city_id', 'name' => 'city_id','title' => 'ID'],
            ['data' => 'name', 'name' => 'name','title' => 'Name'],
            ['data' => 'state', 'name' => 'state','title' => 'State'],
            ['data' => 'country', 'name' => 'country','title' => 'Country'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ]);
        $cities = City::where('state_id', $id)->get();
        if(request()->ajax()) {
            return $dataTable->dataTable($cities)->toJson();
        }
         $state = State::addSelect(['country_name' => Country::select('name')
        ->whereColumn('country_id', 'states.country_id')
        ])->where('state_id',$id)->get();
        return view('admin.location.cities')->with(compact('state','html'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($country_id)
    {
        $state = State::findOrFail($country_id);
        $countries = Country::all();
        return view('admin.location.editState')->with(compact('state','country_id','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $state_id)
    {
        $rules = [
            'state_name' => 'required',
            'state_country' => 'required',

        ];
        $messages = [
            'state_name.required' => 'Enter State name',
            'state_country.required' => 'Please select country',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
          return redirect()->back()
          ->withErrors($validator)
          ->withInput();
        } else {
          $state = State::find($state_id);
          $state->name = $request->state_name;
          $state->country_id = $request->state_country;
          $state->status = '1';
        }
        if ($state->save()) {
            Session::flash('message', 'State Updated Succesfully !');
            Session::flash('alert-class', 'success');

            return redirect('admin/countries/'.$state->country_id);
            //countries/101       

        } else {
            Session::flash('message', 'Oops !! Something went wrong!');
            Session::flash('alert-class', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($state_id)
    {
        //return $state_id;
        $state = State::find($state_id);
        $state->cities()->delete();
        $state->delete();
        return json_encode(['statusCode'=>200]);
    }
   public function getState(Request $request){
      $state = new State();
      $states = $state->getState($request->id);
      $option = '<option></option>';
      if(isset($request->state) && !is_null($request->state)) {
        foreach($states as $state) {
          $option .= '<option value="'.$state['state_id'].'" '.(($request->state == $state['state_id']) ? 'selected': '').'>'.$state['name'].'</option>';
        }
      } else {
        foreach($states as $state) {
          $option .= '<option value="'.$state['state_id'].'">'.$state['name'].'</option>';
        }
      }

      echo $option;
    }
    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,State::class,'status');
    }
}

