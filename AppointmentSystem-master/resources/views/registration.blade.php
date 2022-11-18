<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/customize.css') }}" >
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
            <img id="view_image" src="" alt="Image" class="w-100 h-75" >
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

  
  <div class="container-fluid mt-5" style="width: 90%; height:100%;">
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
      </div>
      <div class="card shadow-sm mb-5" style="">
        <div class=" card-header text-center p-3 font-weight-bold bg-semi-grey">
          Accounts Table
        </div>
          <div class="panel panel-default mt-4" >
            <div class="panel-body">
                <form action="{{route('search_registration')}} " method="GET">
                    @csrf
                    {{ csrf_field() }}
                    <div class=" container-fluid">
                        <input type="search_registration" name="search_registration" id="search" class="form-control mb-3 float-right" placeholder="search" style="width: 300px">
                        <button class="btn mt-1 float-right ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                        </button>
                    </div>
                
                </form>
            </div>
          </div> 
        <div class="card-body table-responsive">
          <table class="table table-hover "  >
            <thead>
                <tr class="text-center">
                  <th scope="col" style="width: 10%">Email</th>
                  <th scope="col" style="width: 10%">Fullname</th>
                  <th scope="col" style="width: 10%">Age</th>
                  <th scope="col" style="width: 10%">Gender</th>
                  <th scope="col" style="width: 10%">Birthdate</th>
                  <th scope="col" style="width: 10%">Address</th>
                  <th scope="col" style="width: 10%">Contact No</th>
                  <th scope="col" style="width: 10%">ID</th>
                
                  <th scope="col" style="width: 10%">Status</th>
                  <th scope="col" colspan="2" class="text-center" style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                @if ($data->account_type!="admin" )
                <tr class="text-center">
                <td>{{$data->email}}</td>
                <td>{{$data->lastname}},{{$data->firstname}} {{$data->middlename}}</td>
                <td>{{$data->age}}</td>
                <td>{{$data->gender}}</td>
                <td>{{$data->birthdate}}</td>
                <td>{{$data->address}}</td>
                <td>{{$data->contactnumber}}</td>
                <td> <button class="btn btn-sm btn-info view" value="{{$data->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg></button>
                </td>
                
                <td>{{$data->status}}</td>
                <td>
                    @if ($data->status !="approved" && $data->status !="rejected" )
                        <div class="d-flex justify-content-center"> 
                          <button class="btn btn-sm btn-primary  approve"    value="{{$data->id}}" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                          </svg>
                        </button>
                          <button class="btn btn-sm btn-warning  ml-2 rejected " value="{{$data->id}}">
                            {{-- <div class="row">
                              <div class="col col-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x-lg" viewBox="0 0 16 16">
                                  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg>
                              </div>
                              <div class="col col-10"> --}}
                                Reject
                              {{-- </div>
                           
                            </div> --}}
                        </button>
                    @endif
                <button class="btn btn-sm btn-danger ml-2 delete" value="{{$data->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg></button>
              </div>
              </td>
                
                </tr>
                @endif
                @endforeach
            
            </tbody>
          </table> 
        </div>
        <div class="m-4"> {{ $datas->Links() }} </div>
     
      </div>
  </div>

{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



<script>
    $(document).ready(function () {
        $(document).on('click', '.approve',function (e) {
            e.preventDefault(); 
            var approve = $(this).val();
            var btn_type = "approved";
            $('#btn_type').val(btn_type);
            $('#approve_id').val(approve);
            $('#approve_modal').modal('show');
            
            });

            $(document).on('click', '.rejected',function (e) {
            e.preventDefault(); 
            var rejected = $(this).val();
            var btn_type = "rejected";
            $('#reject_id').val(rejected);
            $('#reject_modal').modal('show');
            
            });

            $(document).on('click', '.delete',function (e) {
            e.preventDefault(); 
            var del = $(this).val();
            $('#del_id').val(del);
            $('#delete_modal').modal('show');
            
            });

            $(document).on('click', '.view',function (e) {
              e.preventDefault();
              var identification = $(this).val();

              $('#view_modal').modal('show');
              //  $('#image_id').val(identification);

                $.ajax({
                  type: "GET",
                  url: "/view_identification/"+identification,
                  success: function (response) {
                      // console.log(response);
                      $('#image').val(response.identification.identification)
                      $('#image_id').val(response.identification.id)
                      $('#id_type').text(response.identification.identificationtype);
                      $('#view_image').attr('src', 'storage/'+response.identification.identification);
                  }, error: function(error) {
                    console.log(error);
                  
                    }
                  });
              
            });
        
    });
</script>
</x-app-layout>