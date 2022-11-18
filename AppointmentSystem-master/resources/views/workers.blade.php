<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container mt-5 mb-5 table-responsive" >

         
                    
<button class="btn btn-sm btn-primary w-25 float-right mb-3 lg-w-100 ml-lg-2">Add worker</button>
                      
             
                <table class="  table text-align-center">
                    <thead>
                        <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Email</th>

                        <th scope="col">Fullname</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Job title</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan=2>Action</th>



                    



                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                        <th scope="row">1</th>
                        <td>sample</td>
                        <td>sample</td>
                        <td>sample</td>
                        <td>sample</td>
                        <td>sample</td>
                        <td>sample</td>

                        <td scope="row" colspan=2 class="d-sm-flex">
                        <button class="btn btn-sm btn-warning mt-2 mt-lg-0 ml-lg-2 w-100">Edit</button>
                        <button class="btn btn-sm btn-danger mt-2 mt-lg-0 ml-lg-2 w-100">Delete</button>
                    </td>   
                      

              
                        </tr>
                       
                    </tbody>
                </table>
          
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

</x-app-layout>