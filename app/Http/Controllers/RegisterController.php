<?php

namespace App\Http\Controllers;


use App\Models\Register;
use Illuminate\Http\Request;
use Validator;

use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsSuccessful;

class RegisterController extends Controller
{
    //

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
            'password' => 'required|unique:registers|email|min:8',
            
        ]);

        if($validator->passes()) {

            $registered = new Register();

            $registered-> fullName = $request->input('fullName');
            $registered-> userName = $request->input('userName');
            $registered-> email = $request->input('email');
            $registered-> mobile = $request->input('mobile');
            $registered-> password = $request->input('password');
            
            $registered->save();
                
            return response()->json(["result"=> "ok"]);
            // return view('login');
            
        };
        
        return response()->json(['error' => $validator->errors()->all()]) ;

    }
}
