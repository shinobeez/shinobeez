<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/customize.css') }}" >
    <title>Document</title>
<style>

</style>
</head>
<body>
    


    

{{-- Add  Services modal--}}

<div class="modal fade" id="add_services_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

             <form action=" {{ route('add_services') }} " method="POST"  class="m-2">
                @csrf
                {{ csrf_field() }}
                {{-- <input type="text" id="vaccine_del_id" name="vaccine_del_id" hidden > --}}
                    <div class="form-group">
                        <label for="service" class="col-form-label">Service</label>
                        <input type="text" class="form-control" name="add_service_input" id="add_service_input" required>
                    </div>
                
                    <div class="form-group">
                        <label for="service" class="col-form-label">Available Slot</label>
                        <input type="number" class="form-control" name="add_available_slot" id="add_available_slot" min="0" required>
                    </div>
             
               
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm w-25">Save</button>
                        <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">cancel</button>
                        
                    </div>
            </form>
        </div>
       
        </div>
    </div>
    </div>

    {{-- Add vaccine modal--}}

<div class="modal fade" id="add_vaccine_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action="{{ url('add_vaccine') }}" method="POST">

                {{ csrf_field() }}
                <div class="">
                    <x-jet-label for="service" value="{{ __('Select Service') }}"/>
                        <input type="text" id="service_select_id" name="service_select_id" hidden>
                        <select name="service_select" id="service_select" class ="mb-3 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            
                            @foreach ($services as $value)
                              
                                    <option value="{{ $value->id }}"> 
                                        {{ $value->service }} 
                                    </option>
                          
                        
                          @endforeach  
                    
                    
                        </select>
                        <div id="other_services_field">
                            <label for="" id="add_sub_of_service" name="add_sub_of_service"> add </label>
                            <input type="text" class="form-control" name="add_other_services_input_id" id="add_other_services_input_id" hidden>
                            <input type="text" class="form-control" name="add_other_services_input" id="add_other_services_input"  >

                            
                        </div>
                        
                    <div id="vaccine_field_whole" >
                        <x-jet-label for="service" value="{{ __('Select Column') }}"/>

                        <select name="column_select" id="column_select" class ="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="category">Category</option>
                                <option value="vaccine_type">Vaccine Type</option>

                        
                        </select>

            
                        <div id="category_field">
                            <div class="form-group">
                                <x-jet-label for="service" class="mt-3" value="{{ __('Category') }}" />
                                <input type="text" class="form-control" name="add_vaccine_category_input_id" id="add_vaccine_category_input_id" hidden >
                                <input type="text" class="form-control" name="add_vaccine_category_input" id="add_vaccine_category_input" >
                                
                            </div>
                        </div>
                        <div id="vaccine_field">
                          
                            <x-jet-label for="service" class="mt-3" value="{{ __('Select Category') }}" />
                                
                                <select name="vaccine_select" id="vaccine_select" class ="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" >
                    
                                    @if($categories->isEmpty())
                                            <td colspan="3">
                                                No Data
                                            </td>
                                        @else
                                    @endif
                                    @foreach ($categories as $value)
                                    <option value="{{ $value->id }}"> 
                                    {{ $value->category }} 
                               
                                   
                                </option>
                               
                                 @endforeach  
                                
                                
                              </select>
                              
                            <div class="form-group">
                                <x-jet-label for="service" class="mt-3" value="{{ __('Vaccine Type') }}" />
                                <input type="text" class="form-control" name="add_vaccine_input_id" id="add_vaccine_input_id" hidden >
                                <input type="text" class="form-control" name="add_vaccine_input" id="add_vaccine_input" >
                                

                            </div>
                        </div>
                    </div>   
                 

                
                </div>
                <div class="modal-footer">
                    
                        <button type="submit" id="btn_add_vaccine_medicine" class="btn btn-sm w-25 btn-primary btn-sm text-align-center">Add</button>
                    
                    <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">cancel</button>
                    
                </div>
                </form>
        </div>
       
        </div>
    </div>
    </div>
{{-- Edit modal Services--}}

    <div class="modal fade" id="edit_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action=" {{ route('update_services') }} " method="POST" class="m-2">
                @csrf
                {{ csrf_field() }}
                <input type="text" id="id" name="id" hidden>
            <div class="form-group ">
                <label for="service" class="col-form-label">Service</label>
                <input type="text" class="form-control" name="service" id="service" required>
            </div>
            <div class="form-group">
                <label for="available_slot" class="col-form-label">Available Slot</label>
                <input type="number" class="form-control" name="available_slot" id="available_slot" required min="0">
            </div>
            <div class="form-group" id="yesandno_service" name="yesandno_service">
                <label for="service" class="col-form-label">Availability</label>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="choice_service"  value="Yes">
                        <label class="form-check-label" for="Yes" >
                        Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice_service" value="No">
                        <label class="form-check-label" for="No" >
                        No
                        </label>
                  </div>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-sm w-25">Save</button>
                <button type="button" class="btn btn-primary btn-sm w-25" data-dismiss="modal">cancel</button>
                
            </div>
            </form>
        </div>
       
        </div>
        </div>
    </div>

    {{-- Edit mmedicine modal--}}

    <div class="modal fade" id="edit_other_services_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="other_services_modal_title" name="other_services_modal_title">Edit Other Services</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action=" {{ route('update_other_services') }} " method="POST"  class="m-2">
                @csrf
                {{ csrf_field() }}
                <input type="text" id="edit_other_services_id" name="edit_other_services_id" hidden>
            <div class="form-group">
                <label for="service" class="col-form-label">Service</label>
                <input type="text" class="form-control" name="edit_other_services_input" id="edit_other_services_input" required>
            </div>
            <div class="form-group" id="yesandno_other_services" name="yesandno_other_services">
                <label for="other_services" class="col-form-label">Availability</label>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="choice_other_services"  value="Yes">
                        <label class="form-check-label" for="Yes" >
                        Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice_other_services" value="No">
                        <label class="form-check-label" for="No" >
                        No
                        </label>
                  </div>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm w-25">Save</button>
                <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">cancel</button>
                
            </div>
            </form>
        </div>
       
        </div>
        </div>
    </div>
{{-- Edit modal vaccine --}}
<div class="modal fade" id="edit_vaccine_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Vaccine</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action=" {{ route('update_vaccine') }} " method="POST"  class="m-2">
                @csrf
                {{ csrf_field() }}
                <input type="text" id="vaccine_del_id" name="vaccine_del_id" hidden >
            <div class="form-group">
                <label for="service" class="col-form-label">Vaccine</label>
                <input type="text" class="form-control" name="vaccine" id="vaccine" required>
            </div>
            <div class="form-group" id="yesandno_vaccine" name="yesandno_vaccine">
                <label for="vaccine" class="col-form-label">Availability</label>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="choice_vaccine"  value="Yes">
                        <label class="form-check-label" for="Yes" >
                        Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice_vaccine" value="No">
                        <label class="form-check-label" for="No" >
                        No
                        </label>
                  </div>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-sm w-25">Save</button>
                <button type="button" class="btn btn-primary btn-sm w-25" data-dismiss="modal">cancel</button>
                
            </div>
            </form>
        </div>
       
        </div>
    </div>
</div>

{{-- Edit category modal --}}
<div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action=" {{ route('update_category') }} " method="POST"  class="m-2">
                @csrf
                {{ csrf_field() }}
                <input type="text" id="category_update_id" name="category_update_id" hidden>
                <input type="text" id="service_update_id" name="service_update_id" hidden >

            <div class="form-group">
                <label for="service" class="col-form-label">Vaccine</label>
           

                <input type="text" class="form-control" name="category_update" id="category_update" required>
            </div>
            <div class="form-group" id="yesandno_category" name="yesandno_category">
                <label for="category" class="col-form-label">Availability</label>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="choice_category"  value="Yes">
                        <label class="form-check-label" for="Yes" >
                        Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice_category" value="No">
                        <label class="form-check-label" for="No" >
                        No
                        </label>
                  </div>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-sm w-25">Save</button>
                <button type="button" class="btn btn-primary btn-sm w-25" data-dismiss="modal">cancel</button>
                
            </div>
            </form>
        </div>
       
        </div>
    </div>
</div>

 <!-- delete category / confimation -->

 <div class="modal fade" id="delete_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="{{ url ('delete_category') }} " method="POST"  class="m-2">
            @csrf
         
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text"  id="category_del_id" name="category_del_id" hidden>
          Are you sure you want to delete this category?
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary delete_btn btn-sm w-25">Yes</button>
          <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">No</button>
        </div>
         </form>

      </div>
    </div>
  </div>
   <!-- delete service / confimation -->

<div class="modal fade" id="delete_service_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="{{ url ('delete_services') }} " method="POST"  class="m-2">
            @csrf
         
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text"  id="service_del_id" name="service_del_id" hidden>
          Are you sure you want to delete this Service?
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary delete_btn btn-sm w-25">Yes</button>
          <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">No</button>
        </div>
         </form>

      </div>
    </div>
  </div>
 <!-- delete medicine / confimation -->
  <div class="modal fade" id="delete_other_services_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="{{ route('delete_other_services') }} " method="POST"  class="m-2">
            @csrf
         
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" id="delete_other_services_id" name="delete_other_services_id" hidden>
          Are you sure you want to delete this Service?
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary delete_other_service btn-sm w-25">Yes</button>
          <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">No</button>
        </div>
         </form>

      </div>
    </div>
  </div>


 <!-- delete Vaccine / confimation -->

 <div class="modal fade" id="delete_vaccine_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="{{ route('delete_vaccine') }} " method="POST"  class="m-2">
            @csrf
         
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text"  id="delete_vaccine_id" name="delete_vaccine_id" hidden>
          Are you sure you want to delete this Vaccine?
        </div>
        <div class="modal-footer">
         
          <button type="submit" class="btn btn-primary delete_btn btn-sm w-25">Yes</button>
          <button type="button" class="btn btn-secondary btn-sm w-25" data-dismiss="modal">No</button>
        </div>
         </form>

      </div>
    </div>
  </div>

    <div class="container mt-5 mb-5 bg-semi-white" >
      
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
           @elseif (session('warning'))
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
           @endif
        </div>
        <div class="d-flex justify-content-end">
     
                <button class="btn btn-sm add_service_btn btn-primary mt-2 mb-2  " style="width:120px;">Add Service</button>
            

        </div>
        <div class="row">
            <div class=" col col-lg-12 col-12">
                <div class="card shadow-sm">
                    <div class=" card-header text-center p-3 font-weight-bold bg-semi-grey">
                        Service Table
                      </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover "  >
                            <thead class="">
                                <tr>
                                <th scope="col" class="text-center" >View Fields</th>
                                <th scope="col" class="text-center" >ID</th>
                                <th scope="col" class="text-center" >Service</th>
                                <th scope="col" class="text-center" >Available Slot</th>
                                <th scope="col" class="text-center" >Availability</th>
                                <th scope="col" colspan="3" class="text-center ">Action</th>
                    
                                </tr>
                            </thead>
                        
                            <tbody class="text-center">
                                @if($services->isEmpty())      
                                <td colspan="6">
                                    No Data
                                </td>
                        
                                @endif
                                @foreach($services as $service)
                                <div >
                                        <tr class="text-center ">

                                        
                                        <td class="" > 
                                            {{-- <button class="btn btn-sm btn-warning mt-2 mt-lg-0  w-100 edit_service_field" value="{{$service->id}}">Edit</button> --}}
                                            <button class="btn btn-info btn-sm max-width:200px mt-2  edit_service_field" value="{{$service->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>
                                            </button>
                                            
                                        </td>
                                        <td >{{$service->id}}</td>
                                        <td >{{$service->service}}</td>
                                        <td >{{$service->availableslot}}</td>
                                        <td class="">
                                            <div class="">
                                                @if($service->availability == "Yes")
                                                    <button class="btn btn-sm mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                        <circle cx="8" cy="8" r="8"/>
                                                    </svg></button>
                                                    
                                                
    
                                                @else
                                                    <button class="btn btn-sm  mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                        <circle cx="8" cy="8" r="8"/>
                                                    </svg></button>
                                                    
                                                @endif
                                            </div>
                                           
                                        
                                        </td>


                                        <td scope="row" class="d-sm-flex justify-content-center">
                                            
                                            {{-- <button class="btn btn-sm btn-warning mt-2 mt-lg-0 ml-lg-1 w-100 edit_btn" value="{{$service->id}}">Edit</button> --}}
                                            <button class="btn btn-sm btn-success mt-2 edit_btn" value="{{$service->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </button>
                                        {{-- <button class="btn btn-sm btn-danger mt-2 mt-lg-0 ml-lg-1 w-100 delete_service" value="{{$service->id}}">Delete</button> --}}
                                        <button class="btn btn-sm btn-danger mt-2 mt-lg-2 ml-lg-1 delete_service" value="{{$service->id}}">
                                        
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                    </svg>
                                        </button>
                                        </td>
                                        </tr>
                                      
                                </div>
                                @endforeach
                             
                                 
                            </tbody>
                            <div>
                                <tr >
                                    
                                </tr>
                            </div>
                         
                        </table>
                          
                        <div class="row">
                            <div class="col col-7 text-center">
                                <div class="bg-green float-right mb-5 mt-0">Slot Per day: <b> {{$services->pluck('availableslot')->sum()}} </b></div>
                            </div>

                        </div>
                     
                        <div> {{ $services->Links() }} </div>

                    </div>
                </div>
                <div id="add_btn_all" style="display:">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm add_vaccine_btn mt-5 mb-2  btn-primary" style="width:120px;">Add </button>
                    </div>
                </div>   
                <div class="card shadow-sm">
                    <div class=" card-header text-center p-3 font-weight-bold  bg-semi-grey">
                        Vaccine Table
                        
                    </div>
                    <div class="card-body">
                        <div id="vaccine_table" style="display: " class="">
                            <div class="d-flex justify-content-end">
                                <table class="table table-hover">
                                
                                
                                    <thead class="" >
                                    <tr >
                                
                                    <th scope="col"  class="text-center col-9" >List of Category</th>
                            
                                    <th scope="col"  class="text-center col-9" >Availability</th>
                                    <th scope="col" class="text-center col-3" >Action</th>
            
                                    </tr>
                                </thead>
                                <tbody class="text-center" >
                                    @if($categories->isEmpty())
                                        <td colspan="3">
                                            No Data
                                        </td>
                                    
                                    
                                    @endif
                                @foreach($categories as $category)
                                    <tr class="text-center">
                                    <td>{{$category->category}}</td>
                                    <td class="">
                                        <div class="">
                                            @if($category->category_availability == "Yes")
                                                <button class="btn btn-sm mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg></button>
                                                
                                            

                                            @else
                                                <button class="btn btn-sm  mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg></button>
                                                
                                            @endif
                                        </div>
                                       
                                    
                                    </td>
                                    <td scope="row" class="d-sm-flex justify-content-center">
                                                
                                        {{-- <button class="btn btn-sm btn-warning mt-2 mt-lg-0 ml-lg-1 w-100 edit_category" value="{{$category->id}}">Edit</button> --}}
                                            <button class="btn btn-sm btn-success mt-2 mt-lg-0 ml-lg-1 edit_category" value="{{$category->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </button>
                                        
                                    {{-- <button class="btn btn-sm btn-danger mt-2 mt-lg-0 ml-lg-1 w-100 delete_category " value="{{$category->id}}">Delete</button> --}}
                                    <button class="btn btn-sm btn-danger mt-2 mt-lg-0 ml-lg-1 delete_category " value="{{$category->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg></button>

                                    </td>
                                        
                                    </tr>
                            @endforeach
                                </tbody>
                            </table> 
                            
                            </div>
                            <div> {{ $categories->Links() }} </div>

                            <table class="table table-hover  mt-5">
                                    <thead class=" mt-5 " >
                                    <tr >
                                
                                    <th scope="col"  class="text-center" style="width: 25%">Category</th> 
                                <th scope="col"  class="text-center" style="width: 50%">Vaccine</th> 
                                
                                <th scope="col"  class="text-center" style="width: 50%">Availability</th> 
                                    <th scope="col" class="text-center " style="width: 25%">Action</th>

                                    </tr>
                                </thead>
                                <tbody class="text-center" >
                                    @if($vaccines->isEmpty())
                                    
                                    <td colspan="4">
                                        No Data
                                    </td>
                                    
                                        
                                        @endif
                                @foreach($vaccines as $vaccine)
                                    <tr class="text-center">
                                    <td>{{$vaccine->category}}</td>
                                    <td>{{$vaccine->vaccine_type}}</td>
                                    <td class="">
                                        <div class="">
                                            @if($vaccine->vaccine_availability == "Yes")
                                                <button class="btn btn-sm mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg></button>
                                                
                                            

                                            @else
                                                <button class="btn btn-sm  mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg></button>
                                                
                                            @endif
                                        </div>
                                       
                                    
                                    </td>
                                    <td scope="row" class="d-sm-flex justify-content-center">
                                                
                                        <button class="btn btn-sm btn-success mt-2 mt-lg-0 edit_vaccine" value="{{$vaccine->id}}">   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg></button>
                                    <button class="btn btn-sm btn-danger mt-2 mt-lg-0 ml-lg-1 delete_vaccine " value="{{$vaccine->id}}"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg></button>
                                    </td>
                                    
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div> {{$vaccines->links()}}</div>
                <div class="card mt-5 shadow-sm">
                    <div class=" card-header text-center p-3 font-weight-bold  bg-semi-grey ">
                        Other Services Table
                    </div>
                    <div class="card-body">
                        <div id="others_table" class=" " style="">
                            <div class="" >
                            <div class="panel panel-default" >
                                <div class="panel-body">
                                    <form action="{{route('search')}} " method="GET">
                                        @csrf
                                        {{ csrf_field() }}
                                        <div class="">
                                            <input type="search" name="search" id="search" class="form-control w-25 mb-3 float-right" placeholder="search">
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
                            
                            <table class="table table-hover">
                                    <thead class="" >
                                    <tr >
                                    <th scope="col" class="text-center" style="width: 25%">Service ID</th>
                                    <th scope="col" class="text-center" style="width: 25%">Service They Belong</th>
                                    <th scope="col"  class="text-center" style="width:25%"><label id="other_services_title" name="other_services_title"></label>Other Serives</th>
                                    <th scope="col"  class="text-center" style="width:25%"><label id="" name="other_services_title"></label>Availability</th>
                                    <th scope="col" class="text-center" style="width: 25%">Action</th>
            
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="table_other_services" name="table_other_services">
                                    
                                    
                                    @if($other_services->isEmpty())
                                    
                                            <td colspan="6">
                                                No Data
                                            </td>
                                    @else
                                    
                                    @endif
                                @foreach($other_services as $value)
                                    <tr class="text-center">
                                    <td>{{$value->service_id}}</td>
                                    <td>{{$value->service}}</td>
                                    <td>{{$value->other_services}}</td>
                                    <td class="">
                                        <div class="">
                                            @if($value->other_services_availability == "Yes")
                                                <button class="btn btn-sm mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg></button>
                                                
                                            

                                            @else
                                                <button class="btn btn-sm  mt-3 mt-lg-0" style="pointer-events: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg></button>
                                                
                                            @endif
                                        </div>
                                       
                                    
                                    </td>
                                    <td scope="row" class="d-sm-flex justify-content-center">
                                            
                                        <button class="btn btn-sm btn-success mt-2 mt-lg-0 ml-lg-1
                                        edit_other_services" value="{{$value->id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                        
                                    <button class="btn btn-sm btn-danger mt-2 mt-lg-0 ml-lg-1 delete_other_services" value="{{$value->id}}">
                                    
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                        </button>
                                    </td>
                                        
                                    </tr>
                                    
                                @endforeach
                                </tbody>
                            
                            </table> 
                            <div> {{ $other_services->Links() }} </div>
                            </div>
                        </div>
                    </div>	
                </div>
            
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>



<script>
    $(document).ready(function () {

        // $.ajaxSetup({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // }
        // });
        
        // fetch_customer_data();

        // function fetch_customer_data(query = ''){
        //     $.ajax({
        //         url: "{{route('live_search.action') }}",
        //         method: 'GET',
        //         data: {query:query},
        //         dataType: 'json',
        //         success: function (data) {
        //             console.log(data);
        //             $('#table_other_services').html(data.table_data);
        //             $('#total_records').text(data.tota_data)
        //         }
        //     });
        // }

       $(document).on('keyup', '#search', function(){
        var query = $(this).val();
        fetch_customer_data(query);
        
   
        });
        
        $(document).on('click', '.edit_btn',function (e) {
            e.preventDefault();
            var service = $(this).val();
            console.log(service);
            // alert(service); 
            $('#edit_service_modal').modal('show');
            
            $.ajax({
                
                type: "GET",
          
                url: "/edit_services/"+service,
                success: function (response) {
                    // console.log(response.service.service);
                    $('#service').val(response.service.service)
                    $('#id').val(response.service.id)
                    $('#available_slot').val(response.service.availableslot)
                    // $('#radio').val(response.service.availability)
                     if(response.service.availability == "Yes"){
                   
                        $('#yesandno_service').find(':radio[name=choice_service][value="Yes"]').prop('checked', true);
                     }else{
                        $('#yesandno_service').find(':radio[name=choice_service][value="No"]').prop('checked', true);

                     }


                }
            });
        });

        
        //update - edit vaccine

        //field
        $(document).on('click', '.edit_service_field',function (e) {
            e.preventDefault();
            var  vaccine_table = document.getElementById("vaccine_table");
            var add_btn_all = document.getElementById("add_btn_all");
            var medicine_type_table = document.getElementById("medicine_type_table");
            var checkup_table = document.getElementById("checkup_table");
            var others_table = document.getElementById("others_table");
            var service = $(this).val();
            console.log(service);
            // others_table.style.display = "none";
            // alert(service); 
            if(service == "1" ){
                // others_table.style.display = "none";
                // vaccine_table.style.display = "block";
                // add_btn_all.style.display="block";
                var target_div = service;
              
                scrolldiv();

                function scrolldiv() {
                    window.scroll(0,findPosition(document.getElementById("add_btn_all")));
                }
                
            }
            else{
                // $("#other_services_title").text("Others");
                // add_btn_all.style.display="block";
                // vaccine_table.style.display = "none";
                // others_table.style.display ="block";
                scrolldiv();
                function scrolldiv() {
                    window.scroll(0,findPosition(document.getElementById("others_table")));
                }

            }
            
           
        });

     
        function findPosition(obj) {
            var currenttop = 0;
            if (obj.offsetParent) {
                do {
                currenttop += obj.offsetTop;
                } while ((obj = obj.offsetParent));
                return [currenttop];
            }
        }
     

        //name
        $(document).on('click', '.edit_vaccine',function (e) {
            e.preventDefault();
            var vaccine = $(this).val();
                // console.log(vaccine);
            // alert(service); 
            $('#edit_vaccine_modal').modal('show');
                $.ajax({

                    type: "GET",
                    url: "/edit_vaccine/"+vaccine,
                    success: function (response) {
                       
                        // $('#id').val(response.vaccine.id)
                        $('#vaccine_del_id').val(response.vaccine_id.id);
                        $('#vaccine').val(response.vaccine_id.vaccine_type);


                        if(response.vaccine_id.vaccine_availability == "Yes"){
        
                        $('#yesandno_vaccine').find(':radio[name=choice_vaccine][value="Yes"]').prop('checked', true);
                        }else{
                        $('#yesandno_vaccine').find(':radio[name=choice_vaccine][value="No"]').prop('checked', true);

                        }


                    }
                });
        });
        $(document).on('click', '.edit_other_services',function (e) {
            e.preventDefault();
            var other_services = $(this).val();
            console.log(other_services);
            // alert(service); 
            $('#edit_other_services_modal').modal('show');
            
            $.ajax({
                
                type: "GET",
                url: "/edit_other_services/"+other_services,
                success: function (response) {
                    // console.log(response.service.service);
                    console.log(response);
                    $('#edit_other_services_input').val(response.other_services.other_services);
                    $('#edit_other_services_id').val(response.other_services.id);
                   
                    if(response.other_services.other_services_availability == "Yes"){
                        console.log("loggg");
                        $('#yesandno_other_services').find(':radio[name=choice_other_services][value="Yes"]').prop('checked', true);
                    }else{

                        $('#yesandno_other_services').find(':radio[name=choice_other_services][value="No"]').prop('checked', true);

                    }

                }
            });
        });

        //delete service
        $(document).on('click', '.delete_service',function (e) {
        e.preventDefault(); 
        var delete_service = $(this).val();
        $('#service_del_id').val(delete_service);
        $('#delete_service_modal').modal('show');
        
        });

        //delete vaccine
        $(document).on('click', '.delete_vaccine',function (e) {
        e.preventDefault(); 
        var delete_vaccine = $(this).val();
        $('#delete_vaccine_id').val(delete_vaccine);
        
         console.log(delete_vaccine);
        // alert(service); 
        $('#delete_vaccine_modal').modal('show');
        
        });

        $(document).on('click', '.delete_other_services',function (e) {
        e.preventDefault(); 
        var other_services = $(this).val();
        $('#delete_other_services_id').val(other_services);
        // alert(service); 
        $('#delete_other_services_modal').modal('show');
        
        });

        //add service
        $(document).on('click', '.add_service_btn',function (e) {
        e.preventDefault(); 
        $('#add_services_modal').modal('show');

        });

        //add service
        $(document).on('click', '.add_vaccine_btn',function (e) {
        e.preventDefault(); 
        $('#add_vaccine_modal').modal('show');

        });
       
        $("#vaccine_select").on('change',function(e){ 
            e.preventDefault(); 
            var selected_vaccine = $(this).val();
            console.log(selected_vaccine);
            $('#add_vaccine_input_id').val(selected_vaccine);

        
        }).change();

       
        $("#service_select").on('change',function(e){ 
            e.preventDefault(); 
            var service_select_id = $(this).val();
           
            $('#service_select_id').val(service_select_id);
            var btn_add_vaccine_medicine = document.getElementById("btn_add_vaccine_medicine");
           
            $.ajax({

                type: "GET",
                url: "/select_service/"+service_select_id,
                success: function (response) {
                    // $('#id').val(response.vaccine.id)
                    $('#vaccine_field_whole').show();
                    $('#other_services_field').show();

                    if(response.service_id != null){
                        if (response.service_id.id =="1") {
                      
                            $('#vaccine_field_whole').show();
                            $('#other_services_field').hide();
                            btn_add_vaccine_medicine.style.display="block";


                        }else if(response.service_id.id =="2"){
                            $('#add_other_services_input_id').val(response.service_id.id);
                            $('#other_services_field').show();
                            $('#add_sub_of_service').text("add "+response.service_id.service);
                            $('#vaccine_field_whole').hide();
                            $('#vaccine_field_whole').hide();

                            btn_add_vaccine_medicine.style.display="block";

                        }
                        else if(response.service_id.id =="3"){
                            $('#add_other_services_input_id').val(response.service_id.id);
                            $('#vaccine_field_whole').hide();
                            $('#other_services_field').show();
                            $('#add_sub_of_service').text("add "+response.service_id.service);
                        
                            
                        }
                        else{
                            $('#add_other_services_input_id').val(response.service_id.id);
                            $('#vaccine_field_whole').hide();
                            $('#other_services_field').show();
                            $('#add_sub_of_service').text("add "+response.service_id.service);


            
                            

                        }
                    }
                    
                  
                }
                });
     
        }).change();

        $("#column_select").on('change',function(e){ 
            e.preventDefault(); 
            var selected_column = $(this).val();
            if (selected_column == "category"){
                $('#vaccine_field').hide();
                $('#category_field').show();

            }else if (selected_column == "vaccine_type"){
                $('#vaccine_field').show();
                $('#category_field').hide();
            }else{
                $('#vaccine_field').hide();
                $('#category_field').hide();
            }
        }).change();
        

        //edit category
        $(document).on('click', '.edit_category',function (e) {
        e.preventDefault(); 
    
            var edit_category = $(this).val();
          
            
        $('#edit_category_modal').modal('show')

            $.ajax({

                type: "GET",
                url: "/edit_category/"+edit_category,
                success: function (response) {
                    // $('#id').val(response.vaccine.id)
                    console.log(response);
                    $('#category_update_id').val(response.category_id.id);
                    $('#category_update').val(response.category_id.category);
                    $('#service_update_id').val(response.category_id.service_id);

                    if(response.category_id.category_availability == "Yes"){
                        $('#yesandno_category').find(':radio[name=choice_category][value="Yes"]').prop('checked', true);
                    }else{
                        $('#yesandno_category').find(':radio[name=choice_category][value="No"]').prop('checked', true);
                    }
                }
            });
        });
      
        $(document).on('click', '.delete_category',function (e) {
            e.preventDefault();
            var delete_category_id =$(this).val();
            $('#delete_category_modal').modal('show');
            $('#category_del_id').val(delete_category_id);
        });

        $("#yesandno").on('change',function(e){ 
            e.preventDefault(); 
           
           console.log($('#radio:checked').val());
        }).change();

    });
</script>
</x-app-layout>