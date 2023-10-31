<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use Yajra\DataTables\Html\Builder;
use App\DataTables\CountryDataTable;
use App\DataTables\StateDataTable;
use Session;
use Validator;
use App\DataTables\CityDataTable;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder, CountryDataTable $dataTable)
    {
       $html = $builder->columns([
            ['data' => 'country_id', 'name' => 'country_id','title' => 'ID'],
            ['data' => 'sortname', 'name' => 'sortname','title' => 'Sortname'],
            ['data' => 'name', 'name' => 'name','title' => 'Name'],
            ['data' => 'phonecode', 'name' => 'phonecode','title' => 'Phonecode'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ]);
        $countries = Country::all();
        if(request()->ajax()) {
            return $dataTable->dataTable($countries)->toJson();
        }
        return view('admin.location.countries', compact('html'),compact('countries'));
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
        $deleteRules = ',NULL,country_id,deleted_at,NULL';
         $rules = [
          'short_code' => "required|unique:countries,sortname$deleteRules",
          'country_name' => "required|unique:countries,name$deleteRules",
          'phonecode' => "required|unique:countries,phonecode$deleteRules",
        ];

        $messages = [];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
          return redirect()->back()
          ->withErrors($validator)
          ->withInput();
        } else {
            $country = new Country;
            $country->sortname = $request->short_code;
            $country->name = $request->country_name;
            $country->phonecode = $request->phonecode;
            $country->status = '1';
            if ($country->save()) {
              Session::flash('message', 'Country Added Succesfully !');
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
    public function show(Builder $builder, StateDataTable $dataTable,$country_id)
    {
        $html = $builder->columns([
            ['data' => 'state_id', 'name' => 'state_id','title' => 'ID'],
            ['data' => 'name', 'name' => 'name','title' => 'Name'],
            ['data' => 'country', 'name' => 'country','title' => 'Country'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ]);
        $countries = Country::where('country_id',$country_id)->get();
        $states = State::where('country_id', $country_id)->get();
        if(request()->ajax()) {
            return $dataTable->dataTable($states)->toJson();
        }
        return view('admin.location.states')->with(compact('country_id', 'countries','html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.location.editCountry')->with(compact('country'));
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
        $deleteRules = ",$id,country_id,deleted_at,NULL";
         $rules = [
          'short_code' => "required|unique:countries,sortname$deleteRules",
          'country_name' => "required|unique:countries,name$deleteRules",
          'phonecode' => "required|unique:countries,phonecode$deleteRules",
        ];
        /*
        $rules = [
          'short_code' => 'required|unique:countries,sortname,'.$id.',country_id',
          'country_name' => 'required|unique:countries,name,'.$id.',country_id',
          'phonecode' => 'required|unique:countries,phonecode,'.$id.',country_id',
        ];
        */

      $messages = [];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()) {
          return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      } else {
          $country = Country::find($id);
          $country->sortname = $request->short_code;
          $country->name = $request->country_name;
          $country->phonecode = $request->phonecode;
          $country->status = '1';
      }
      if ($country->save()) {
          Session::flash('message', 'Country Updated Succesfully !');
          Session::flash('alert-class', 'success');
          return redirect('admin/countries');
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
    public function destroy($id)
    {
        if(isset($id)){
            $country = Country::find($id);
            foreach ($country->states as $state) {
              $state->cities()->delete();
            }
            $country->states()->delete();
            $country->delete();
            return json_encode(['statusCode'=>200]);

        }
        
    }

    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Country::class,'status');
    }

    public function getCountry(Request $request){
        $countries = Country::where('status', '1')->get()->toArray();
  
        $option = '<option></option>';
        if(!empty($countries)) {
          foreach($countries as $country) {
            $option .= '<option value="'.$country['country_id'].'">'.$country['name'].'</option>';
          }
        }
  
        echo $option;
    }

    public function getStates(Request $request){
        $states = State::where('country_id', $request->id)->where('status','1')->get()->toArray();
        $option = '<option disabled selected>Select State</option>';
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

    public function getCities(Request $request){

        $cities = City::where('state_id', $request->id)->where('status','1')->get()->toArray();
        
        $option = '<option disabled selected>Select City</option>';
        if(isset($request->city) && !is_null($request->city)) {
            foreach($cities as $city) {
                $option .= '<option value="'.$city['city_id'].'"'.(($request->city == $city['city_id']) ? 'selected': '').'>'.$city['name'].'</option>';
            }
        } else {
            foreach($cities as $city) {
                $option .= '<option value="'.$city['city_id'].'">'.$city['name'].'</option>';
            }
        }
  
        echo $option;
    }

    public function editState($country_id) {
        $state = State::findOrFail($country_id);
        $countries = Country::findOrFail($state->country_id);
        return view('admin.location.editState')->with(compact('state','country_id','countries'));
    }

    public function updateState(Request $request){
        $rules = [
          'state_name' => 'required',
        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
          return redirect()->back()
          ->withErrors($validator)
          ->withInput();
        } else {
          $state = State::find($request->state_id);
          $state->name = $request->state_name;
          //$state->country_id = $request->state_country;
          $state->status = '1';
        }
        if ($state->save()) {
            Session::flash('message', 'State Updated Succesfully !');
            Session::flash('alert-class', 'success');
            return redirect('admin/state/'.$state->country_id);
        } else {
            Session::flash('message', 'Oops !! Something went wrong!');
            Session::flash('alert-class', 'error');
            return redirect('admin/state/'.$state->country_id);
        }
    }

    public function showCity(Builder $builder, CityDataTable $dataTable,$state_id)
    {
        $html = $builder->columns([
            ['data' => 'city_id', 'name' => 'city_id','title' => 'ID'],
            ['data' => 'name', 'name' => 'name','title' => 'Name'],
            ['data' => 'state_id', 'name' => 'state_id','title' => 'State'],
            ['data' => 'status', 'name' => 'status','title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at','title' => 'Scaned At'],
            ['data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false,'title' => 'Action'],
        ]);
        $state = State::where('state_id',$state_id)->first();
        $city = City::where('state_id', $state_id)->get();
        if(request()->ajax()) {
            return $dataTable->dataTable($city)->toJson();
        }
        return view('admin.location.cities')->with(compact('html','state'));
    }

    public function editCity($city_id) {
        $city = City::findOrFail($city_id);
        if($city){
          $state = State::findOrFail($city->state_id);
          $countries = Country::findOrFail($state->country_id);
          return view('admin.location.editCity')->with(compact('state','city','countries'));
        }else{
          abort(404);
        }
    }

    public function updateCity(Request $request){
        $rules = [
          'city_id' => 'required',
          'city_name' => 'required',
        ];
    
        $messages = [
    
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if($validator->fails()) {
          return redirect()->back()
          ->withErrors($validator)
          ->withInput();
        } else {
          $record = City::find($request->city_id);
          $record->name = $request->city_name;
          $record->status = '1';
        }
        if ($record->save()) {
            Session::flash('message', 'State Updated Succesfully !');
            Session::flash('alert-class', 'success');
            return redirect()->route('viewCityList',[$record->state_id]);
        } else {
            Session::flash('message', 'Oops !! Something went wrong!');
            Session::flash('alert-class', 'error');
            return redirect()->back();
        }
    }

    public function storeCity(Request $request) {
        $rules = [
            'city_name' => 'required',
            // 'city_country' => 'required|exists:countries,country_id',
            // 'city_state' => 'required|exists:states,state_id'
        ];

        $messages = [
            'city_country.required' => 'Please select a Country.',
            'city_state.required' => 'Please select a State.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $city = new City;
            $city->name = $request->city_name;
            $city->state_id = $request->city_state;
            if ($city->save()) {
              Session::flash('message', 'City Added Succesfully !');
              Session::flash('alert-class', 'success');
              return redirect('admin/countries');
            } else {
              Session::flash('message', 'Oops !! Something went wrong!');
              Session::flash('alert-class', 'error');
              return redirect('admin/countries');
            }
        }
    }

    public function storeState(Request $request) {
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

    public function deleteCity($id)
    {
        if(isset($id)){
            $record = City::find($id);
            $record->delete();
            return json_encode(['statusCode'=>200]);

        }
        
    }

    public function cityChangeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,City::class,'status');
    }

    public function deleteState(Request $request,$id) {
        $state = State::find($id);
        $city = City::where('state_id',$state->state_id)->delete();
        $state->delete();
        return json_encode(['statusCode'=>200]);
    }
  
    public function stateChangeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,State::class,'status');
    }

    public function countryChangeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,Country::class,'status');
    }

}
