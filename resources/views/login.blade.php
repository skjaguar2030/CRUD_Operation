<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container mt-4">

        @if(session('message'))

        <div class="alert alert-danger"> {{session('message')}} </div>
        @endif
        

        
        <form action="{{route('register.login.check')}}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email" value="">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Password</label>
                <input type="password" class="form-control" id="exampleFormControlFile1" name="password">
                <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
            </div>

            

            <button type="submit" class="btn btn-secondary" name="register">Login</button>

        <p>Don't have an account ? <a href="{{route('register.register')}}">Register</a></p>


            {{-- <a href="{{route('register.register')}}">
                <button type="button" class="btn btn-primary" >
                Register
            </button>
        </a> --}}

        </form>

    </div>
    
</body>
</html>
