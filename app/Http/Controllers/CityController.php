<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\State;
use App\Country;
use DataTables;
use Validator;
use Session;
use DB;
class CityController extends Controller
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
        
        $rules = [
            'city_name' => 'required',
            'city_country' => 'required|exists:countries,country_id',
            'city_state' => 'required|exists:states,state_id'
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
              return redirect('admin/state/'.$request->city_state);
            } else {
              Session::flash('message', 'Oops !! Something went wrong!');
              Session::flash('alert-class', 'error');
              return redirect('admin/state/'.$request->city_state);
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
    public function edit($city_id)
    {
        $city = City::findOrFail($city_id);
        $countries = Country::all();
        $country_id = $city->state->country->country_id;
        $states = State::where('country_id',$country_id)->get();
//        dd($city1);
        return view('admin.location.editCity')->with(compact('city','country_id','countries','states'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $city_id)
    {
        // 
        //echo "string";
        //dd($request->input());
        $rules = [
            'city_country' => 'required',
            'city_state' => 'required',
            'city_name' => 'required',

        ];
        $messages = [
            'city_country.required' => 'Please select country',
            'city_state.required' => 'Please select State',
            'city_name.required' => 'Enter City name',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
          return redirect()->back()
          ->withErrors($validator)
          ->withInput();
        } else {

          $city = City::find($city_id);

          $city->name = $request->city_name;
          $city->state_id = $request->city_state;
          $city->state->country_id = $request->city_country;
          $city->status = '1';
        }
        if ($city->save()) {
            Session::flash('message', 'City Updated Succesfully !');
            Session::flash('alert-class', 'success');

            return redirect('admin/state/'.$city->state_id);
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
    public function destroy($city_id)
    {
        $city = City::find($city_id);
        if($city){
            $city->delete();
            return json_encode(['statusCode'=>200]);
           }
        else
           return json_encode('Something went to wrong');
           
    }
    public function changeStatus(Request $request)
    {
        return $this->UpdateStatus($request->id,City::class,'status');
    }
    public function getCities(Request $request){

      $model = new City();
      $cities = $model->getCity($request->id);
      $option = '<option></option>';
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
}

