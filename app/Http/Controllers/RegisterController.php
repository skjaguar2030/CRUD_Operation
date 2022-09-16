<?php

namespace App\Http\Controllers;


use App\Models\Register;
use Illuminate\Http\Request;
use Validator;

use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsSuccessful;

class RegisterController extends Controller
{
    //

    public function login () 
    {
        
        return view('login');

    }

    public function auth(Request $request){

        // validate

        $user = Register::where(['email'=> $request->email, 'password'=> $request->password])->first();

        // $user = Register::where(['email'=> $request->email])
        //                   ->where(['password'=> $request->password])->first();

        if($user){
            session(['loggedIN' => $user->id]);
            return redirect()->route('employee.index');

        }
        else{
            return redirect()->back()->with(["message"=> "Credentials doesn't match"]);
        }




        // Via a request instance...
// $request->session()->put('key', 'value');
 
// Via the global "session" helper...
    }

    public function register () 
    {
        
        return view('registration');

    }

    public function store(Request $request)
    {

        $validator = $request->validate([

            'fullName' => 'required|unique:registers|max:255',
            'userName' => 'required|unique:registers|max:255',

            'email' => 'required|unique:registers|email|min:8',
            'mobile' => 'required',
            // 'mobile' => 'required|',
            'password' => 'required',
            
        ]);

        if($validator == true) {

            $registered = new Register();

            $registered-> fullName = $request->input('fullName');
            $registered-> userName = $request->input('userName');
            $registered-> email = $request->input('email');
            $registered-> mobile = $request->input('mobile');
            $registered-> password = $request->input('password');
            
            $registered->save();
                
            // return response()->json(["result"=> "ok"]);
            // return view('login');

            return view('retrieve');
            
        };
        
        // return response()->json(['error' => $validator->errors()->all()]) ;
        return redirect()->route('employee.index');

    }
}
