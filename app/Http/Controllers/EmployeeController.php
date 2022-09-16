<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;

use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsSuccessful;
//  Controllers are not required to extend a base class. However, you will not have access to convenient features such as the middleware and authorize methods.

class EmployeeController extends Controller
// a UserController class might handle all incoming requests related to users, including showing, creating, updating, and deleting users.
{
    public function index() 
    {
        // return view('retrieve');

        // $data = Employee::all();

        $data = Employee::withTrashed()->get();

        // $amakuru = Random::withTrashed()->get();


        // return view('retrieve', ['employee' => $data ]);  // don't understand how 'employee' is used in order to retrieve data in our table

        // Sometimes the connection fails because xammp hasn't started. Make sure to start it!

        return view('retrieve');
    }

    // public function create() 
    // {
    //     return view('create');
    // }

    public function store(Request $request)
    {


        // dd($request->all());

        // This is the validation method
        $validator = $request->validate([

            'name' => 'required|unique:employees|max:255',
            'email' => 'required|email|min:8',
            'salary' => 'required|',
            // 'mobile' => 'required|',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if($validator->passes()) {

            $employee = new Employee();

            if($file = $request->file('image')){

                $filename = time().$file->getClientOriginalName();

                $file->move(public_path('uploads'), $filename);

                $employee->image = $filename;
                
            }

            $employee-> name = $request->input('name');
            $employee-> email = $request->input('email');
            $employee-> salary = $request->input('salary');
            $employee-> mobile = $request->input('mobile');
            
            $employee->save();
                
            return response()->json(["result"=> "ok"]);
            
        };
        
        return response()->json(['error' => $validator->errors()->all()]) ;

        //This code underneath is uselless since we're validating our form
        // $employee = new Employee();

        // // Actually there is even a shorter way to upload an image to musql database

        // // public function store (Request $request) {
  
        // //     $imageName = time().'.'.$request->image->getClientOriginalExtension();
        // //     $request->image->move(public_path('/uploadedimages'), $imageName);
          
        // //     // then you can save $imageName to the database
          
        // //   }  // The above code is from stackOverflow

        // // This condition here allows us 
        // if($file = $request->file('image')) {
        //     //store file into stamps folder

        //     // I got this from stackOverflow -> "  Use the file() method to access the uploaded file "

        //     // StackOverflow even proposed me this line of code
        //     // $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
 

        //     $filename = time().$file->getClientOriginalName();
        //     // don't really understand what this declaration is supposed to do???

        //     $file->move(public_path('uploads'), $filename);

        //     $employee->image = $filename;

        //     return response()->json(["result"=> "ok"]);
        // }


        // $employee-> name = $request->input('name');
        // $employee-> email = $request->input('email');
        // $employee-> salary = $request->input('salary');
        // $employee-> mobile = $request->input('mobile');
        
        // $employee->save();

        // if($employee->save()){
        //     return response()->json(["result"=> "ok", "data"=> Employee::all()]);  // how is this code supposed to be executed???
        // }
        // else{
        //     return response()->json(["result"=> "error"]);

        // }


        // // try {
        // //     //code...
        // //     $employee->save();

        // // } catch (\Throwable $th) {
        // //     //throw $th;

        // // return response()->json(["result"=> $th]);
        

        // // }

        // return response()->json(["result"=> "ok"]);


        // // return redirect()->route('employee.index');
    }

    public function edit($id){
        $employee = Employee::where('id', '=', $id)->first();

        // return $employee->name;

        return view('update', ['employee' => $employee]);
    }

    public function update(Request $request){
        
        // From here we start requesting the image file
        if($request->hasFile('image')) {  // If the image file exists then execute the following code


            if(file_exists(public_path('uploads/' . Employee::find($request->id)->image))){  // if the image file already exits then delete the current one that in the uploads folder

                unlink(public_path('uploads/' . Employee::find($request->id)->image));
                
            } else { dd("File doesn't exist"); }

            if($file = $request->file('image')) {
                //store file into stamps folder
    
                $filename = time().$file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
    
                $image = $filename;
            } 

        } else{ $image = Employee::find($request->id)->image; }

        // $image = ""; // this is an error that occured stating that image is undefined

        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $salary = $request->salary;
        $mobile = $request->mobile;

        
        // Employee::WHERE('id', $id)->update([
        //     'name' => $name,
        //     'email' => $email,
        //     'salary' => $salary,
        //     'mobile' => $mobile,
        //     'image' => $image,
        // ]);




        $update = Employee::WHERE('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'salary' => $salary,
            'mobile' => $mobile,
            'image' => $image,
        ]);

        // the code below was used when we hadn't start executing our application using ajax.

        // return redirect()->route('employee.index')->with('aka_naga_session', 'Vyakunze petit, hagiyemwo ivyo wipfuza genda rero!!!');

        // return response()->json(["employee" => Employee::find($request->id)]);

        // if(Employee::WHERE('id', $id)->update()){
        //     return response()->json(["result"=> "ok", "data"=> Employee::all()]);  // how is this code supposed to be executed???
        // }

        if($update){
            return response()->json(["result"=> "ok"]);

        } else{ return response()->json(["result"=> "error"]); }

    }

    
    public function restore($id)
    {

        // $restore = Random::WHERE ("id", $id)->restore();

        if(Employee::WHERE ("id", $id)->restore()){
            
            // return redirect()->route('employee.index');

            return response()->json(["result"=> "ok"]);


        } else{ echo 'error'; }

    }


    public function delete($id)
    {

        // if(file_exists(public_path('uploads/' . Employee::find($id)->image))){

        //     unlink(public_path('uploads/' . Employee::find($id)->image));
            
        // } else { dd("File doesn't exist"); }
        
        if(Employee::find($id)->delete()){
            // return redirect()->route('employee.index')->with('aka_naga_session_kogufuta', 'Wamwishe ndakeee, yagiyeee... Byeeeeeeeeee!!!');

            return response()->json(['result' => 'ok']);

        } else { return response()->json(['result' => 'error']); }

    }

    // for hard deleting

    public function destroy($id)
    {

        if(file_exists(public_path('/uploads/' . Employee::onlyTrashed()->where('id', $id)->get()[0]->image))){

            unlink(public_path('/uploads/' . Employee::onlyTrashed()->where('id', $id)->get()[0]->image));
                
        } else { dd("File doesn't exist"); }

        if(Employee::WHERE ("id", $id)->forceDelete()){
            
            // return redirect()->route('employee.index');

            return response()->json(["result"=> "ok"]);


        } else{ echo 'error'; }

    }


    
    // for the create button
    public function employeeList()
    {

        return response()->json(["employee" => Employee::withTrashed()->get()]);

    }

    // for the update button
    public function employeeListEdit($id)
    {

        return response()->json(["employee" => Employee::find($id)]);

    }

    
}
