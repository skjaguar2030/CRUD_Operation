<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

  <div class="container">

    
    <form action="{{route('employee.update', ['id' => $employee->id])}}" method="post" enctype="multipart/form-data">

      @csrf

      <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" name="name" value="{{$employee->name}}">
          <div id="emailHelp" class="form-text">We'll never share your name with anyone else.</div>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email" value="{{$employee->email}}">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>

      <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Salary</label>
          <input type="decimal" class="form-control" id="exampleInputName" aria-describedby="emailHelp"  name="salary" value="{{$employee->salary}}">
          <div id="emailHelp" class="form-text">We'll never share your Salary with anyone else.</div>
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">mobile</label>
        <input type="text" class="form-control" id="exampleInputPassword1"  name="mobile" value="{{$employee->mobile}}">
        <div id="emailHelp" class="form-text">We'll never share your phone number with anyone else.</div>
      </div>

      <div class="form-group">
        <label for="exampleFormControlFile1">Upload image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
      </div>

      <img src="{{asset('uploads')}}/{{$employee->image}}" alt="picture" width="80px">

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>

    </form>

  </div>
    
</body>
</html>