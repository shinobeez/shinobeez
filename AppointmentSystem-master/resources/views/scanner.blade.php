<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" /> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script> --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <title>Document</title>

        <script type="text/javascript" src="{{ asset('instascan.min.js') }}" ></script>

    </head>
    <body>
    
      <!-- modal view-->
    
    
    <!-- Modal -->
    <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header mb-2 mt-4" >
            <p class="text-center">
              <h5>
               <small class="font-weight-light ">IDENTIFICATION CARD</small>
              </h5>
             
              
            </p>
          </div>
          <div class="modal-body">
            <div class="container">
             
              <div class="row">
                <input type="text" id="image_id" name="image_id" hidden>
                {{-- <input type="text" id="image" name="image"> --}}
                <img id="view_image" src="" alt=".." class="w-100 h-75" >
                {{-- <img src="storage/images/dsgLLgapwjZkOGRWmspJX9t2vIbnnv2kJaYWvEYq.jpg" alt=".." > --}}
              </div>
              <div class="row d-flex justify-content-center mt-4 mb-2">
                <div class="text-center">
                  <div class="row">
                    ID type:<p id="id_type" class="text-center ml-2 font-weight-bold text-lowercase h5"></p></p>
                  </div>
        
    
                </div>
              </div>
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
      <!-- modal delete-->
      <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
    
            <form action="{{ url ('delete_registration') }} " method="POST">
                @csrf
               
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text"  id="del_id" name="del_id" hidden>
              Are you sure you want to delete this registration?
            </div>
            <div class="modal-footer">
             
              <button type="submit" class="btn btn-primary delete_btn btn-sm w-25">Yes</button>
              <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">No</button>
            </div>
             </form>
    
          </div>
        </div>
      </div>
    <!-- reject modal -->
    
      <div class="modal fade" id="reject_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
    
            <form action="{{ url ('reject_registration') }} " method="POST">
                @csrf
              
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text"  id="reject_id" name="reject_id" hidden>
            
              Are you sure you want to reject this registration?
            </div>
            <div class="modal-footer">
             
              <button type="submit" class="btn btn-primary reject_btn btn-sm w-25">Yes</button>
              <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">No</button>
            </div>
             </form>
    
          </div>
        </div>
      </div>
    
    
         <!-- approve modal -->
    
    <div class="modal fade" id="approve_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
    
            <form action="{{ url ('approve_registration') }} " method="POST">
                @csrf
               
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text"  id="approve_id" name="approve_id" hidden>
            
              Are you sure you want to approve this registration?
            </div>
            <div class="modal-footer">
             
              <button type="submit" class="btn btn-primary approve_btn btn-sm w-25">Yes</button>
              <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">No</button>
            </div>
             </form>
    
          </div>
        </div>
      </div>
      

   

      
{{--     
        <div class="container-fluid mt-5 mb-5 table-responsive w-100" >
          <div>
            @if (session('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            @elseif (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
            @endif
        </div> --}}
          <div class="container mt-5 mb-5" >
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            
        </div>
        @endif
          <div class="card w-70" style="margin-top: 100px 150px;" >
            
                {{-- <h4>Verify Appointment</h4> --}}
            
                    
              <div class="card-body rounded">
                <div class="row">
                  <div class="col col-12 d-flex d-flex justify-content-center mt-4">
                    <h5>Scan QR Code</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col d-flex justify-content-center mt-4 ">
                    <video id="preview" class="w-25 " style="display:none">
                      
                    </video>
                  </div>
                </div>
                <div class="row">
                  <div class="col col-12 d-flex d-flex justify-content-center mb-4 mt-2">
                    <div class="m-1">
                      <button type="button" onclick="initQrCodeScanner()" class="btn btn-primary btn-sm scan1 " style="width:90px">Scan</button>
                    </div>
                    <div class="m-1">
                      <button type="button" class="btn btn-danger btn-sm  cancel" style="width:90px" id="cancel">Stop</button>  
                    </div>
                  </div>
                </div>

                <div class="row" id="display_verification" style="display:none" name="">
                  <div class="col d-flex justify-content-center mt-5">
                    {{-- <input type="text" id="appointment_id_hidden" name="appointment_id_hidden" hidden >
                    <input type="text" id="user_id" name="user_id_hidden"  hidden> --}}
                  

                      <form action="{{route('verify_appointment') }}" method="POST" class="w-25">
                        @csrf
                        {{ csrf_field() }}
                        <input type="text" id="user_contactnumber" name="user_contactnumber" hidden > 
                        <input type="text" id="appointment_id_hidden" name="appointment_id_hidden" hidden> 
                        <input type="text" id="appointment_date_hidden" name="appointment_date_hidden" hidden> 
                        <input type="text" id="user_contactnumber_hidden" name="user_contactnumber_hidden" hidden> 
                        <input type="text" id="appointment_services_hidden" name="appointment_services_hidden" hidden> 
                        <input type="text" id="appointment_services_id_hidden" name="appointment_services_id_hidden" hidden> 
                        
                        
                        

                        <fieldset disabled>
                         
                          <div class="form-group">
                            <label for="appointment_id">User ID</label>
                            <input type="text" id="user_id" name="user_id" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="appointment_id">Appointment ID</label>
                            <input type="text" id="appointment_id" name="appointment_id" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="disabledTextInput">Service</label>
                            <input type="text" id="appointment_services" name="appointment_services" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="disabledTextInput">Appointment Date</label>
                            <input type="text" id="appointment_date" name="appointment_date" class="form-control">
                          </div>
                        </fieldset>
                            <div class="row d-flex justify-content-center">
                              <button type="submit" class="btn btn-primary btn-sm w-50">Verify</button>
                            </div>
                      </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
    
    
     {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>  --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
    </html>
    
    
    
   <script>
        //  const Instascan = require('instascan');

         
        // $(document).ready(function () {

       

        //   let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        //   scanner.addListener('scan', function (content) {
        //     console.log(content);
        //   });
        //   Instascan.Camera.getCameras().then(function (cameras) {
        //     if (cameras.length > 0) {
        //       scanner.start(cameras[0]);
        //     } else {
        //       console.error('No cameras found.');
        //     }
        //   }).catch(function (e) {
        //     console.error(e);
        //   }); 



        //     $(document).on('click', '.approve',function (e) {
        //         e.preventDefault(); 
        //         var approve = $(this).val();
        //         var btn_type = "approved";
                
                
        //         $('#btn_type').val(btn_type);
        //         $('#approve_id').val(approve);
               
        //         // console.log(approve);
        //         // alert(service); 
        //         $('#approve_modal').modal('show');
                
        //         });
    
        //         $(document).on('click', '.rejected',function (e) {
        //         e.preventDefault(); 
        //         var rejected = $(this).val();
        //         var btn_type = "rejected";
                
                
             
        //         $('#reject_id').val(rejected);
    
        //         // $('#email').val(btn_type);
    
                
        //         // $('#approve_id').val(approve);
               
        //         // console.log(btn_type);
        //         // alert(service); 
        //         $('#reject_modal').modal('show');
                
        //         });
    
        //         $(document).on('click', '.delete',function (e) {
        //         e.preventDefault(); 
        //         var del = $(this).val();
        //         // var btn_type = "rejected";
                
                
        
        //         $('#del_id').val(del);
    
        //         // $('#email').val(btn_type);
    
                
        //         // $('#approve_id').val(approve);
               
        //         // console.log(btn_type);
        //         // alert(service); 
        //         $('#delete_modal').modal('show');
                
        //         });
    
        //         $(document).on('click', '.view',function (e) {
        //           e.preventDefault();
        //           var identification = $(this).val();
    
        //           $('#view_modal').modal('show');
        //           //  $('#image_id').val(identification);
    
        //             $.ajax({
                    
        //             type: "GET",
        //             url: "/view_identification/"+identification,
        //              success: function (response) {
        //                 // console.log(response);
        //                 $('#image').val(response.identification.identification)
        //                 $('#image_id').val(response.identification.id)
        //                 $('#id_type').text(response.identification.identificationtype);
        //                 $('#view_image').attr('src', 'storage/'+response.identification.identification);
        //             }, error: function(error) {
        //                console.log(error);
                     
        //     }
        //         });
                  
        //         });
            
        // });
     

                const initQrCodeScanner = () => {
                  var cancel = document.getElementById('cancel');
                  var x = document.getElementById("preview");
                  var display_verification = document.getElementById("display_verification");

                  if (x.style.display == "none") {
                    x.style.display = "block";
                  }
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                
                Instascan.Camera.getCameras().then(cameras => {
                  console.log(cameras.length);
                  if(cameras.length > 0){
                    if(scanner.camera = cameras[cameras.length - 2]){
                       scanner.start();
                    }else{
                      alert("camera 2 not found!");
                    }
                   
                  }else {
                    alert("no camera found!");
                  }
                  

                }).catch(e => console.error(e));

 

                scanner.addListener('scan', content => {
                  // scanner.stop();
                  console.log(content);

                      $.ajax({
                        type: "GET",
                        url: "/get_appointment_id/"+content,
                        success: function (response) {
                            console.log(response);

                  
                              var len = 0;
                              if(response['data'] != null){
                            
                                    display_verification.style.display = "block";
                                  len = response['data'].length;
                                  
                                  if(len > 0){
                                    for(var i=0; i<1; i++){
                                
                                    $('#appointment_id').val(response['data'][i].appointment_id);
                                    $('#appointment_id_hidden').val(response['data'][i].appointment_id);
                                    $('#appointment_id_hidden').val(response['data'][i].appointment_id);
                                    $('#appointment_services').val(response['data'][i].appointment_services);
                                    $('#appointment_services_hidden').val(response['data'][i].appointment_services);
                                    $('#appointment_services_id_hidden').val(response['data'][i].service_id);


                                    $('#appointment_date').val(response['data'][i].appointment_date);
                                    $('#appointment_date_hidden').val(response['data'][i].appointment_date);

                                    $('#user_id').val(response['data'][i].user_id);
                                    $('#user_contactnumber').val(response['data'][i].user_contactnumber);
                                    $('#user_contactnumber_hidden').val(response['data'][i].user_contactnumber);

                                      }
                                        // x.style.display = "none";
                                      }else{
                                        alert("No existing Appointment!");
                                      }
                          
                              }else {
                                alert("No existing Appointment!");
                              }
                            
                          
                        }, error: function(error) {
                          console.log(error);
                          }
                      });


                  
                 
                });
              
                cancel.addEventListener('click', function () {
                  scanner.stop();
                  x.style.display = "none";
                });
            
              };  
        

             
        
    
    </script>
    </x-app-layout>