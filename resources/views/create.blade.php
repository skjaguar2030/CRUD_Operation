<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
  <body>

    <div class="container">

        {{-- This form will act based on the public function (it can also be reffered as a method) that I named "store" which is inside the EmployeeController --}}
        <form id="createFrm" action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">

            @csrf         {{-- CSRF is implemented within HTML forms declared inside the web applications. You have to include a hidden validated CSRF token in the form, so that the CSRF protection middleware of Laravel can validate the request.
              
            Cross-site request forgeries are a type of malicious exploit whereby unauthorized commands are performed on behalf of an authenticated user. Thankfully, Laravel makes it easy to protect your application from cross-site request forgery (CSRF) attacks. --}}

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" name="name">
              <div id="emailHelp" class="form-text">We'll never share your name with anyone else.</div>
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Salary</label>
              <input type="decimal" class="form-control" id="exampleInputName" aria-describedby="emailHelp"  name="salary">
              <div id="emailHelp" class="form-text">We'll never share your Salary with anyone else.</div>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">mobile</label>
              <input type="text" class="form-control" id="exampleInputPassword1"  name="mobile">
              <div id="emailHelp" class="form-text">We'll never share your phone number with anyone else.</div>
            </div>

            <div class="form-group">
              <label for="exampleFormControlFile1">Upload image</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>

   
    
  </body>
</html>