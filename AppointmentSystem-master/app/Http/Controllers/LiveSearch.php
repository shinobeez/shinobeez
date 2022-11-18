<?php

namespace App\Http\Controllers;
use App\Models\Other_Services;
use Illuminate\Http\Request;
use DB;
class LiveSearch extends Controller
{
    function index()
    {
     return view('services');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('other_services')
         ->where('service_id', 'like', '%'.$query.'%')
         ->orWhere('other_services', 'like', '%'.$query.'%')
         ->orWhere('other_services', 'like', '%'.$query.'%')
         ->get();
         
      }
      else
      {
       $data = DB::table('other_services')
         ->orderBy('service_id', 'asc')
         ->get();
      }

      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->service_id.'</td>
         <td>'.$row->other_services.'</td>
         <td> '.'<btn class="btn btn-sm btn-primary edit_medicine" value="'.$row->service_id .'">Edit</btn>'.'</td>

        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
