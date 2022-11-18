<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    function registration(Request $request){
         $datas = User::paginate(10);

         if ($request->has('search_registration')) {
          $datas = DB::table('users')->where('id','LIKE','%'.$request->search_registration.'%')
          ->orWhere('firstname','LIKE','%'.$request->search_registration.'%')
          ->orWhere('middlename','LIKE','%'.$request->search_registration.'%')
          ->orWhere('lastname','LIKE','%'.$request->search_registration.'%')
          ->orWhere('gender','LIKE','%'.$request->search_registration.'%')
          ->orWhere('birthdate','LIKE','%'.$request->search_registration.'%')
          ->orWhere('age','LIKE','%'.$request->search_registration.'%')
          ->orWhere('identification','LIKE','%'.$request->search_registration.'%')
          ->orWhere('identificationtype','LIKE','%'.$request->search_registration.'%')
          ->orWhere('contactnumber','LIKE','%'.$request->search_registration.'%')
          ->orWhere('address','LIKE','%'.$request->search_registration.'%')
          ->orWhere('email','LIKE','%'.$request->search_registration.'%')
          ->orWhere('account_type','LIKE','%'.$request->search_registration.'%')
          ->orWhere('status','LIKE','%'.$request->search_registration.'%')
          ->orWhere('contactnumber','LIKE','%'.$request->search_registration.'%')
          ->paginate(10);
          // dd($users_search);
        }else{
          $datas = DB::table('users')->paginate(10);
        }

        if(Auth::User()->account_type=='admin'){
          
            return view ('registration',compact('datas'));
          }else{
              return redirect()->route('calendar');
  }
    }

    function approve_registration(Request $request){

        $approve_id = $request ->input ('approve_id');
        $approve = User::find($approve_id);
        $approve ->status = "approved";
        $approve->update();
      
        if(Auth::User()->account_type=='admin'){
            return redirect()->back()->with('success', 'Registration Approved');
          }else{
            return redirect()->route('login');
          }
    
    }

    function reject_registration(Request $request){

        $reject_id = $request ->input ('reject_id');
        $reject = User::find($reject_id);
        $reject ->status = "rejected";
        $reject->update();
        if(Auth::User()->account_type=='admin'){
            return redirect()->back()->with('danger', 'Registration Rejected');
          }else{
            return redirect()->route('login');
          }
    
    }

    function delete_registration(Request $request){
        $del_reg_id = $request ->input ('del_id');
        $del_reg = User::find($del_reg_id);
        $del_reg->delete();
        if(Auth::User()->account_type=='admin'){
            return redirect()->back()->with('danger', 'Successfully Deleted');
          }else{
            return redirect()->route('login');
          }
     
    
    }

    
    public function view_identification($id){
      $identification = User::find($id);
      return response()->json([
            'status'=>200,
            'identification'=> $identification,
            'identificationtype'=> $identification,

    
      ]);
    
    
    
     }  


        
    
   
}
