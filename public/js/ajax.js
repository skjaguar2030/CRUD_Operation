


function buildTable(){

    // AJAX

    $.ajax({
        method: "GET",
        
        url: '/employeeList',
        processData: false,
        dataType: " JSON",
        contentType: false,
        cache: false, 

    })
    .done(function(response){

        let table = "";

        response.employee.forEach(element => {

            let row = ` <tr> 
                <td><img src="/uploads/${element.image}" alt="picture" width="40px"></td>
                <td>${element.name}</td>
                <td>${element.email}</td>
                <td>${element.salary}</td>
                <td>${element.mobile}</td>
                <td>`
                    
                    if(element.deleted_at == null){

                        row+= `<button type="button" class="btn btn-success js-edit" url="/employeeList/${element.id}">Edit</button>
                        <button type="button" class="btn btn-warning js-delete" url="/delete/${element.id}">Delete</button>`;

                    } else{

                        row+= `<button type="button" class="btn btn-primary js-restore" url="/restore/${element.id}">Restore</button>
                        <button type="button" class="btn btn-danger js-destroy" url="/destroy/${element.id}">Destroy</button>`;

                    }
                    

                   
                   
                    // aha niho nakwamiye baguma banyandikira uti "Undefined constant 'element'. " 

                    // {{-- @if(${element.deleted_at} == null) --}}  
                   

                

                   

                row+= `</td></tr>`;

            table += row;

        });

        $('#table tbody').html(table);

    })
    .fail(function(error){
        console.log(error)
    })


}

buildTable();

// $(document).ready(function(){  // This method prevents our javascript code to not be executed before the page is done loading. This can be an advanta because sometimes a page may take much time to load due to the javascript code.

    const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'),{
        keyboard: false,

    });

    const editModal = new bootstrap.Modal(document.getElementById('editModal'),{
        keyboard: false,

    });

    $('#openmdl').on('click', e => {

        myModal.show();

    });

    // $('#editModal').on('click', e => {

    //     editModal.show();

    // });


    $('#createFrm').on('submit', function(event){

        event.preventDefault();

        var form = document.getElementById('createFrm');
        let img = document.getElementById("image").files[0];
        // let img = document.getElementById("image").files[0];




        let formData = new FormData(form);  // What does this class do? Howw does this work?
        // formData.append("image", img);


        // ajax;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // what is this used for. How does it work?
            }
        });

        $.ajax({
            method: "POST",
            data: formData,
            url: '/store',  // 
            processData: false,
            dataType: "JSON",
            contentType: false,
            cache: false
        
        })
        .done(function(response){
            console.log(response);
            console.log(response.result)
            if(response.result == "ok"){
                // $('.message').show();

                Swal.fire('Data submitted sucfly!', '', 'success')
                form.reset();  // what is this method supposed to do
                myModal.hide();
                buildTable();


            }
        })
        .fail(function(error){
        console.log(error);
        });



        
    })

    // Here we are populating our form

    $('#table').on('click', '.js-edit', function(e){

        editModal.show();

        var URL = $(this).attr("url");

        console.log(URL);

        $.ajax({
            method: "GET", 
            url: URL,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",
            
        })
        .done(function(resp){

            console.log(resp);
            $('#name').val(resp.employee.name)
            $('#email').val(resp.employee.email)
            $('#salary').val(resp.employee.salary)
            $('#mobile').val(resp.employee.mobile)
            $('#id').val(resp.employee.id)

            $('#edit_image').attr({src:'/uploads/' + resp.employee.image})

        })

    })

    // This is the editing part

    $('#editFrm').on('submit', function(event){

        // alert();

        event.preventDefault();

        var form = document.getElementById('editFrm');

        let img = document.getElementById("image").files[0];  // What is rhis variable holding and when or where is it going tobe used
    
        let formData = new FormData(form);

        formData.append('image', img);  // A must learn. This type of data can't be sent with the inputs contained within the form so we have to append in order to send the file input to the server and update successfully.

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            data: formData,
            url: '/update',

            // type: "PATCH", // Gt this from the internet don't really know how it works or when it's used.
            
            processData: false,
            dataType: "JSON",
            contentType: false,
            cache: false
    
        })
        .done(function(response){
        
            console.log(response);
            // console.log(response.result)
            if(response.result == "ok"){   // Result it comes from controller in create fct inside if statement
            

                form.reset();
                editModal.hide();
                buildTable();  
            }
        })
        .fail(function(error){
            console.log(error);
        });

    })

    // This is the restoring part

    $('#table').on('click', '.js-restore', function(e){

        // alert();

        // event.preventDefault();

        var URL = $(this).attr("url");


       // let img = document.getElementById("image").files[0];  // What is rhis variable holding and when or where is it going tobe used
    
        // let formData = new FormData(form);

        // formData.append('image', img);  // A must learn. This type of data can't be sent with the inputs contained within the form so we have to append in order to send the file input to the server and update successfully.


        $.ajax({
            method: "GET",
            // data: formData,
            url: URL,

            // type: "PATCH", // Gt this from the internet don't really know how it works or when it's used.
            
            processData: false,
            dataType: "JSON",
            contentType: false,
            cache: false
    
        })
        .done(function(response){
        
            console.log(response);
            // console.log(response.result)
            if(response.result == "ok"){   // Result it comes from controller in create fct inside if statement
            
                buildTable();  
            }
        })
        .fail(function(error){
            console.log(error);
        });

    })

    // this is the deleting part

    $('#table').on('click', '.js-delete', function(e){

        var URL = $(this).attr("url");

        console.log(URL);

        const swalWithBootstrapButtons = Swal.mixin({

            customClass: {

                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'

            },

            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true

        })
        .then((result) => {

            if (result.isConfirmed) {
                
                $.ajax({
                    method: "GET", 
                    url: URL,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                
                })

                .done(function(resp){

                    console.log(resp);

                    if(resp.result == 'ok') {

                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'This account has been deleted.',
                            'success'
                        );

                        buildTable();

                    }

                })

                .fail(function(er){

                    console.log(er)

                })

            } else if ( result.dismiss === Swal.DismissReason.cancel) {

                swalWithBootstrapButtons.fire(
                'Cancelled',
                'account has not been deleted and is safely kept',
                'error'
                )
            }

        })

    })


    // this is the part where we delete permanently

    $('#table').on('click', '.js-destroy', function(e){

        // alert();

        // event.preventDefault();

        var URL = $(this).attr("url");

        // console.log(URl)

        console.log(URL);


       // let img = document.getElementById("image").files[0];  // What is rhis variable holding and when or where is it going tobe used
    
        // let formData = new FormData(form);

        // formData.append('image', img);  // A must learn. This type of data can't be sent with the inputs contained within the form so we have to append in order to send the file input to the server and update successfully.


        $.ajax({
            method: "GET",
            // data: formData,
            url: URL,

            // type: "PATCH", // Gt this from the internet don't really know how it works or when it's used.
            
            processData: false,
            dataType: "JSON",
            contentType: false,
            cache: false
    
        })
        .done(function(response){
        
            // console.log(response);
            // console.log(response.result)
            if(response.result == "ok"){   // Result it comes from controller in create fct inside if statement
            
                buildTable();  
            }
        })
        .fail(function(error){
            console.log(error);
        });

    })
    

    // {{-- From here we finished populating the inputs in our form

// });



    

// The code for our model ends from here



    // the codes below were used in order to set functionalities to tje create model

//     //  codes for our model starts from here 
//     $('.message').hide();



//     const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'),{
//         keyboard: false,

//     });

//     $('#openmdl').on('click', e => {

//         myModal.show();

//     });



//     $('#createFrm').on('submit', function(event){

//         event.preventDefault();

//         var form = document.getElementById('createFrm');
//         let img = document.getElementById("image").files[0];
//         // let img = document.getElementById("image").files[0];




//         let formData = new FormData(form);  // What does this class do? Howw does this work?
//         // formData.append("image", img);


//         // ajax;

//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // what is this used for. How does it work?
//             }
//         });

//         $.ajax({
//             method: "POST",
//             data: formData,
//             url: "{{route('employee.store')}}",  // 
//             processData: false,
//             dataType: "JSON",
//             contentType: false,
//             cache: false
        
//         })
//         .done(function(response){
//             console.log(response);
//             console.log(response.result)
//             if(response.result == "ok"){
//                 // $('.message').show();

//                 Swal.fire('Data submitted sucfly!', '', 'success')
//                 form.reset();  // what is this method supposed to do
//                 myModal.hide();
//                 BuildTable(response.data);


//             }
//         })
//         .fail(function(error){
//         console.log(error);
//         });

//     })

//     //   data = [{}, {}, {}]
//     // {} = row;

//     function BuildTable(data){

//         let table = "";

//         data.forEach(element => {

//             let row = ` <tr> 
//                 <td><img src="/uploads/${element.image}" alt="picture" width="40px"></td>
//                 <td>${element.name}</td>
//                 <td>${element.email}</td>
//                 <td>${element.salary}</td>
//                 <td>${element.mobile}</td>
//                 <td>
//                     <a href="/edit/${element.id}"><button type="button" class="btn btn-primary">Edit</button></a>
//                     <a href="/delete/${element.id}"><button type="button" class="btn btn-danger">Delete</button></a>

//                 </td>
//             </tr> `;


//             table += row;


            
//         });

//         $('#table tbody').html(table);


//     }
// // `</div>`  //this is where my container ends --}}
