<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Company</title>
       
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>


    <body>

        {{-- <a href={{ route('employee.create') }}>Create</a> --}}
        <div class="container">

            <div style="margin-top: 42px; position: relative" class="m-auto m-t-2">
                @if(session('aka_naga_session'));
                    <div class="alert alert-success" role="alert">
                        {{session('aka_naga_session')}}
                    </div>
            
                @endif
            </div>

            <div style="margin-top: 42px; position: relative" class="m-auto m-t-2">
                @if(session('aka_naga_session_kogufuta'))
                    <div class="alert alert-success" role="alert">
                        {{session('aka_naga_session_kogufuta')}}
                    </div>
            
                @endif
            </div>

                {{-- This anchor tag redirects us to the subscription form page --}}

                <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" id="openmdl" style="float: right; margin-top:2em;">
                Create
            </button>

                {{-- {{$defaulData}} --}}




            <table id="table" class="table">
                <thead>
                    <tr>
                        <th scope="col">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>

                <tbody>

             

                </tbody>

            </table>
        </div>




        {{-- Model starts here --}}

    
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        {{-- form starts here --}}


                        <div class="container">

                            {{-- <div class="message ">

                                <div class="alert alert-success" role="alert">
                                    Employee added successfuly!!!
                                </div>
                                
                            </div> --}}
                    

                            {{-- This form will act based on the public function (it can also be reffered as a method) that I named "store" which is inside the EmployeeController --}}

                            {{-- This is form is going to be querried ( $ ) and is going to act upon the code written in line 230 --}}
                            <form id="createFrm" action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
                    
                                @csrf         {{-- CSRF is implemented within HTML forms declared inside the web applications. You have to include a hidden validated CSRF token in the form, so that the CSRF protection middleware of Laravel can validate the request.
                                
                                Cross-site request forgeries are a type of malicious exploit whereby unauthorized commands are performed on behalf of an authenticated user. Thankfully, Laravel makes it easy to protect your application from cross-site request forgery (CSRF) attacks. --}}
                    
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" name="name">
                                    <div id="emailHelp" class="form-text">We'll never share your name with anyone else.</div>
                                    <div class="error_msg_name"></div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                    <div class="error_msg_email"></div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Salary</label>
                                    <input type="decimal" class="form-control" id="exampleInputName" aria-describedby="emailHelp"  name="salary">
                                    <div id="emailHelp" class="form-text">We'll never share your Salary with anyone else.</div>
                                    <div class="error_msg_salary"></div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">mobile</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"  name="mobile">
                                    <div id="emailHelp" class="form-text">We'll never share your phone number with anyone else.</div>
                                    <div class="error_msg_mobile"></div>
                                </div>
                    
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                    <div class="error_msg_image"></div>
                                </div>
                    
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                    
                                <button type="submit" class="btn btn-primary">Submit</button>
                    
                            </form>


                        </div>
                


                        {{-- form starts here --}}

                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </div>
            </div>
        </div>
        



        {{-- Model ends here --}}




        {{-- Model for edit form starts here --}}

    
        <!-- Modal -->
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        {{-- form starts here --}}


                        <div class="container">

                            {{-- <div class="message ">

                                <div class="alert alert-success" role="alert">
                                    Employee added successfuly!!!
                                </div>
                                
                            </div>  --}}

                            {{-- This form will act based on the public function (it can also be reffered as a method) that I named "store" which is inside the EmployeeController --}}

                            {{-- This is form is going to be querried ( $ ) and is going to act upon the code written in line 230 --}}
                            <form id="editFrm" action="" {{-- action="{{route('employee.update')}}"  --}} {{-- action="{{route('employee.edit')}}" I think this action might be the proper one but I am not sure to be honest --}} method="post" enctype="multipart/form-data">
                    
                                @csrf         {{-- CSRF is implemented within HTML forms declared inside the web applications. You have to include a hidden validated CSRF token in the form, so that the CSRF protection middleware of Laravel can validate the request.
                                
                                Cross-site request forgeries are a type of malicious exploit whereby unauthorized commands are performed on behalf of an authenticated user. Thankfully, Laravel makes it easy to protect your application from cross-site request forgery (CSRF) attacks. --}}
                    
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                                    <div id="emailHelp" class="form-text">We'll never share your name with anyone else.</div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"  name="email">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Salary</label>
                                    <input type="decimal" class="form-control" id="salary" aria-describedby="emailHelp"  name="salary">
                                    <div id="emailHelp" class="form-text">We'll never share your Salary with anyone else.</div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">mobile</label>
                                    <input type="text" class="form-control" id="mobile"  name="mobile">
                                    <div id="emailHelp" class="form-text">We'll never share your phone number with anyone else.</div>
                                </div>
                    
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>

                                <img src="" id="edit_image" alt="profile" srcset="" style="margin: 1em 0">

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>

                                <input type="hidden" id="id" name="id">  {{-- This is was missing so my form can send data and update my table using ajax. This input is crucial --}} {{-- Another thing to take in consideration is that in order to access a specific image in the database you have to request it through it's table id  --}}
                    
                                <button type="submit" class="btn btn-primary" name="update" >Update</button>
                    
                            </form>


                        </div>
                


                        {{-- form starts here --}}

                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </div>
            </div>
        </div>
        
        {{-- Model for edit form ends here --}}


        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
        
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
        <script src="{{asset('/js/ajax.js')}}"></script>

    </body>
</html>