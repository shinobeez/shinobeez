<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\appointments;
use App\Models\services;
use App\Models\Vaccine;
use App\Models\Category;
// use App\Models\Medicine;
use App\Models\Other_Services;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class CalendarController extends Controller
{
    
    public function calendar ()
    {

        $schedules = array();
        $schedulesall = array();

        // $appointments1 = appointments::all();
        
        if(Auth::User()->id){
            $id = Auth::User()->id;
        }
        if(Auth::User()->account_type=='user'){    
        $schedule_calendar = DB::table('appointments')->where('user_id',$id)->where('appointment_status',"pending")->get();

        }else{
                    
        $schedule_calendar = DB::table('appointments')->get();

        }

    

        $category = Category::all();
        $vaccine = Vaccine::all();
        $services = services::all();


       
        if($services->isEmpty()){
            $yes = 0;
        }else{
            $yes = 1;

        }
       
        
        $appointment_service = services::all(); 
        $current_date =Carbon::now()->toDateTimeString();

    

        $appointment_expire = appointments::all(); 
        $pending = "pending";
        
      appointments::where('appointment_date',"<=",$current_date)->where('appointment_status',$pending)->update(['appointment_status' => "expired"]);
        


        $vaccine_kids= DB::table('categories_vaccine')
        ->join('vaccine','categories_vaccine.id',"=",'vaccine.category_id')
        ->where('categories_vaccine.id',1)
        ->get();

        $vaccine_covid= DB::table('categories_vaccine')
        ->join('vaccine','categories_vaccine.id',"=",'vaccine.category_id')
        ->where('categories_vaccine.id',2)
        ->get();
        
        $vaccine_others= DB::table('categories_vaccine')
        ->join('vaccine','categories_vaccine.id',"=",'vaccine.category_id')
        ->where('categories_vaccine.id',">",2)
        ->get();

        $data3 = Other_Services::pluck('service_id','other_services');
        
       
        $color = '#0AA52B';

        foreach ($schedule_calendar as $value) {
            $color = null;
            if ($value->service_id == 1){
                $color = '#008000';
            }else if ($value->service_id == 2){
                $color = '#6495ED';
            }else if ($value->service_id == 3){
                $color = '#E9F73D ';
            }else if ($value->service_id == 4){ 
                $color = '##3D9AF7';
            }else if ($value->service_id == 5){
                $color = '#F73DE4 ';
            }else if ($value->service_id == 6){
                $color = '#F78F3D';
            }else{
                $color = '#6ED8F1';
            }
           
            $schedules[] = [
                'id' =>  $value->id,
                'title' => $value->appointment_services,
                'start' => $value->appointment_date,
                'color' => $color,
                'textColor'=> 'white'
                // 'vaccinetype' => $appointment2->vaccinetype,
                // 'person' => $appointment2->person,
        ];  

        }

     
        if(Auth::User()->account_type=='admin'){
            return view ('calendar', compact('schedules','appointment_service','category','vaccine','yes') );
        // console.log($appointment_service);
         }else{
            $qrcode = 13;
            // return view ('calendar', ['schedules' =>  $schedules]);
            return view ('calendar', compact('schedules','appointment_service','vaccine_kids','vaccine_others','category','qrcode','vaccine','vaccine_covid','yes','data3') );
         }
    }


    public function action(Request $request){
        // if($request->ajax()){
        //     if(request->){

        //     }
        // }

    }

    public function get_other_services ($id){
        echo json_encode (DB::table('services')->join('other_services','services.id',"=",'other_services.service_id')->where('other_services.service_id',$id)->get());
       
    }

    public function get_service($id){
    $id = services::find($id);

    return response()->json([
        'services'=> $id,
    ]);

    }


    // public function fetch_data(Request $request)
    // {
    //     $select = $request->get('select');
    //     $value = $request->get('value');
    //     $dependent = $request->get('dependent');
    
    //     $data = DB::table('other_services')->where('service_id',$value)->get();
    
    //     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
    //     foreach($data as $row)
    //     {
    //     $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
    //     }
    //     echo $output;
    //     var_dump($output);
    // }



    public function delete_appointment(Request $request){

        $id = $request ->input ('calendar_id');
        $delete_appointment= appointments::find($id);
       
        
        $update_slot = DB::table('appointments')->where('id',$id)->get();
       
        foreach($update_slot as $value){
            $appointment_date = $value->appointment_date;
            $service_id = $value->service_id;
            $appointment_slot = $value->appointment_availableslot;
           
        }
        $update = appointments::where("appointment_date",$appointment_date)->where("service_id",$service_id)->update(['appointment_availableslot' => $appointment_slot+1]);
        
       

        // appointments::where("appointment_date",$appointmentDate)
        // ->update(['appointment_availableslot' => $appointment_slot]);

            $delete_appointment->delete();
      
        if(Auth::User()->account_type=='admin'){
          return redirect()->back()->with('danger', 'Successfully Deleted');
        }else{
         return redirect()->route('calendar');
        }

    }

    public function preview_appointment($id){

        $id = appointments::find($id);
        // $service_id = User::find($id);

        $appointment =  response()->json(['appointment'=> $id,]);
        return $appointment ;

        
    }

    public function preview_qrcode($id){
        // $data = appointments::find(13);
        $qrcode = QrCode::size(120)->generate('123123');
        // return  ('calendar',['qrcode'=>$qrcode]);
        return redirect()->back()->with('qrcode',$qrcode);
    }

}
