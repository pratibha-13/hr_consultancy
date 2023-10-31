<?php

namespace App\Http\Controllers\Website;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Hash;
use Illuminate\Support\Facades\Password;
use Image;
use File;


class UserController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Landing page with details
     */
    public function login(Request $request)
    {
        return view('website.login');
    }

    public function signInStore(Request $request)
    {
        // dd($request);
        // validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
                $user = User::where('email', $request['email'])->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('homepage');
            } else {
                Session::flash('loginerrors', 'Invalid Credentials');
                return redirect()->back();
            }
        }
    }

    public function signup(Request $request)
    {
        return view('website.signup');
    }

    public function signupStore(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required',
        ];

        $messages = [
            'name.required' => 'Enter Name.',
            'password.required' => 'Enter Password.',
            'confirm_password.required' => 'Confirm Password.',
            'email.required' => 'Enter Email.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user=new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request['password']);
            $user->user_status = '1';
            $user->role_id = 2;
        }
        if ($user->save()) {
            $users = User::where('email', $request['email'])->first();
            Auth::login($users);
            Session::flash('message', 'Registered Succesfully !');
            Session::flash('alert-class', 'success');
            return redirect()->route('homepage');
        } else {
            Session::flash('message', 'Oops !! Something went wrong!');
            Session::flash('alert-class', 'error');
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'sometimes',
            // 'password' => 'sometimes',
            // 'npassword' => 'sometimes',
            // 'cpassword'  => 'sometimes|same:npassword',
        ];

        $messages = [
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::find(Auth::id());
            if(isset($request['name']) && $request['name'] != '') {
                // dd($request['name']);
                $user->name = $request['name'];
            }
            if($request->file('image') != null){
                $uriSegments = explode("/", parse_url($user->profile_image, PHP_URL_PATH));
                $lastUriSegment = array_pop($uriSegments);
                // dd
                if($lastUriSegment && file_exists(base_path().'/resources/uploads/profile/'.$lastUriSegment)){
                          unlink(base_path().'/resources/uploads/profile/'.$lastUriSegment); // correct
                    }
                $newImageName="";
                $folderPath = base_path().'/resources/uploads/profile/';
                $file=$request->file('image');
                $newImageName = rand().'_'.$file->getClientOriginalName();
                $file_name = str_replace(" ", "", $newImageName);
                $file->move($folderPath, $file_name);
                $user->profile_image = $file_name;
                }
            }
            if (isset($request['password']) && $request['password'] != '') {
            if (Hash::check($request['password'], $user->password)) {
                $user->password = bcrypt($request['npassword']);
                $user->save();
                Session::flash('message', 'Password updated successfully!!');
                Session::flash('alert-class', 'success');
                return redirect()->back();
            } else {
                Session::flash('message', 'Oops !! current password is wrong, please try again.');
                Session::flash('alert-class', 'error');
                return redirect()->back();
            }
        }
        if ($user->save()) {
            Session::flash('message', 'Profile Upadeted Succesfully !');
            Session::flash('alert-class', 'success');
            return redirect()->back();
        } else {
            Session::flash('message', 'Oops !! Something went wrong!');
            Session::flash('alert-class', 'error');
            return redirect()->back();
        }
    }

    public function emailcheck(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        if (!empty($user)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function checkPassword(Request $request)
    {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            $user = Auth::attempt($credentials);
        if ($user) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function forgotPassword(Request $request)
    {
        $user=User::where('email',$request['email'])->first();
        if($request['email'] == "")
        {
            return 0;
        }
        elseif(empty($user)){
            return 1;
        }else{
            if (Password::sendResetLink(['email' => $user->email]))
            {
                return 2;
                // return $this->APIResponse->respondWithMessage(Lang::get('messages.passwordrecoverylinksent'));
            }
            else
            {
                return 3;
                // return $this->APIResponse->respondWithMessage(Lang::get('messages.pleasetryagin'));
            }
        }
    }
}
