<?php

namespace App\Http\Controllers\Website;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\ContactUs;
use DB;
use Session;
use Validator;

class ContactUsController extends Controller
{
    public function contactUs()
    {
        return view('website.contactUs');
    }

    public function store(Request $request)
    {
    //     return 1;
    //    dd($request);
        $rules = [
            // 'name' => 'required',
            // 'email' => 'sometimes',
            // 'phone_number' => 'sometimes',
            // 'subject' => 'sometimes',
            // 'description' => 'sometimes',
        ];

        $messages = [
           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $contact = new ContactUs;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone_number = $request->phone_number;
            $contact->subject = $request->subject;
            $contact->description = $request->description;
            if ($contact->save()) {
              Session::flash('message', 'contactUs Added Succesfully !');
              Session::flash('alert-class', 'success');
              return view('website.contactUs');
            } else {
              Session::flash('message', 'Oops !! Something went wrong!');
              Session::flash('alert-class', 'error');
              return redirect()->back();
            }
        }
    }
}
