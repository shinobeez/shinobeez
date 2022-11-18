<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Calendar;
use App\Models\appointments;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
 

    public function appointment()
    {
        if(Auth::User()->account_type=='admin'){
            return view('services');
            }else{
              return redirect()->route('appointment');
            }
           
    }
    

    public function get_app(){

    }
    public function appointments_admin(Request $request)
    {

      // $appointments = appointments::all();
      $user = User::with('appointments')->get();
      $appointments = appointments::with('users')->get();

      if ($request->has('search_appointments')) {
        $appointments = DB::table('users')->join('appointments','users.id',"=",'appointments.user_id')->where('email','LIKE','%'.$request->search_appointments.'%')->orWhere('appointment_services','LIKE','%'.$request->search_appointments.'%')
        ->orWhere('appointment_vaccine_category','LIKE','%'.$request->search_appointments.'%')
        ->orWhere('appointment_vaccine_type','LIKE','%'.$request->search_appointments.'%')
        ->orWhere('appointment_date','LIKE','%'.$request->search_appointments.'%')
        ->orWhere('appointment_expiration_date','LIKE','%'.$request->search_appointments.'%')
        ->orWhere('appointment_status','LIKE','%'.$request->search_appointments.'%')
        ->paginate(10);
      }else{

        $appointments = DB::table('users')->join('appointments','users.id',"=",'appointments.user_id')->paginate(10);
      }

  
        if(Auth::User()->account_type=='admin'){
            return view('appointment',compact('appointments','user'));
          }else{
            return redirect()->route('appointment');
          }
      
    }
    protected $global_appointmentDate;
    protected $global_today=null;
   
    public function insert(Request $request){

      $request_service = $request ->input ('appointmentservice');
      $service_id =  DB::table('services')->where('id',$request_service)->get();
      if(!$service_id->isEmpty()){

       $appointment = new appointments();
      // $current_id = Auth::User()->id();
        if(Auth::User()->id){
          $current_id = Auth::User()->id;
          $contactnumber = Auth::User()->contactnumber;
         
        }


        $appointment ->user_id = $current_id;
        $appointment ->user_contactnumber= $contactnumber;

        $randomAppointmentId=rand(0,999999999999);

        $today = \Carbon\Carbon::today()->format('Y/m/d');
        $appointmentDate = \Carbon\Carbon::parse($request ->input ('appointmentdate'))->format('Y/m/d');

        $global_appointmentDate = $appointmentDate;
        $global_today = $today;

        if($appointmentDate < $today){
          return redirect()->back()->with('danger', "Invalid Appointment Date!");
        }else{

          
          $service_slot=  DB::table('services')->where('id',$request_service)->get();
          $appointment_slot =  DB::table('appointments')->where('appointment_availableslot','<=',0)->get();
          
      


          foreach ($appointment_slot as $value) {
            if ($value->service_id == $request_service) {
           
                  if(\Carbon\Carbon::parse($value->appointment_date)->format('Y/m/d') == $appointmentDate ){
                  
                    return redirect()->back()->with('danger', "Service is not available");
                  }
                
                   
           
        
            }
          }
          
          // $appointment_max =  DB::table('appointments');

          $appointment_max=  DB::table('users')->join('appointments','users.id',"=",'appointments.user_id')->where('user_id' ,"=", $current_id)->where('appointment_status',"pending")->get();


          foreach ($appointment_max as $value) {
            if($value->user_id){
              return redirect()->back()->with('danger', "You have an ongoing appointment!");
            }

         
          
          }
       

          // if($appointment_slot){
           
          // }
          
          // foreach ($appointment_slot as $value){
          //   if($value->availableslot){

          //   }
          // }
          // if($request_service ){

          // }
         
          $request_category = $request ->input ('appointmentCategory');
          $request_category = $request ->input ('appointmentCategory');


       
         $categories_id =  DB::table('categories_vaccine')->where('id',$request_category)->get();


        
         foreach ($service_id as $value) {
          $service_name = $value->service;
          $service_id = $value->id;
         }
          
          
         foreach ($categories_id as $value) {
          $categories_name = $value->category;
          $categories_id = $value->id;
         
          }
          
          
          if($service_id == 1){
            if($request ->input ('appointmentCategory')){
              $appointment ->appointment_services = $service_name;
              $appointment ->appointment_vaccine_category = $categories_name;

                if($categories_id == 1){
                  
                  $vaccine_id = $request ->input ('vaccine_type_kids');
                }else if ($categories_id == 2){
                  $vaccine_id= $request ->input ('vaccine_type_covid');
                }else if ($categories_id == 3){
                  $vaccine_id = $request ->input ('vaccine_type_others');

                }else{
                  $vaccine_id = $request ->input ('vaccine_type_others');
                }

               $vaccine_id =  DB::table('vaccine')->where('id',$vaccine_id)->get();

               foreach ($vaccine_id as $value) {
                $vaccine_type = $value->vaccine_type;
                }

              $appointment ->appointment_vaccine_type = $vaccine_type;
            
            }
          }else{
            if($request ->get('appointment_service_others')){
              $request_other_service = $request ->get('appointment_service_others');
           
            
              $categories_other_service_id =  DB::table('services')->join('other_services','services.id',"=",'other_services.service_id')->where('other_services.id',$request_other_service)->get();
  
             
  
              foreach ($categories_other_service_id as $value) {
               $other_service_name = $value->service;
              
               $other_service_category = $value->other_services;
              }
  
              $appointment ->appointment_services = $other_service_name;
              $appointment ->appointment_vaccine_category = $other_service_category;
            }
       
          }
    
        // echo $mytime->toDateTimeString();

        $message_schedule = "Service ". $service_name ." has been scheduled!";
        $expire = Carbon::now()->addHours(48);

        $expiration_date = "\n Expiration Date: \n".\Carbon\Carbon::parse($expire)->format('Y/m/d'." " .'h:m a');
        $message_appointment = $message_schedule."\n".$expiration_date;
        
        //temporary disabled text message
        // $this->sendMessage($message_appointment, $contactnumber);
        
        $appointment_expirationdate = Carbon::now()->addHours(48)->toDateTimeString();
      
        
        $appointment ->appointment_expiration_date = $appointment_expirationdate;

        //==============================================

      
            $message = $request ->input ('appointmentservice');
          $appointment ->appointment_date = $appointmentDate;
          $appointment ->appointment_id = $randomAppointmentId;

          $appointment ->service_id = $request_service;
        
              $kk = null;

              if ($appointmentDate == $today) {
                
                  if( DB::table('appointments')->where('appointment_availableslot',null)->get()){
                    $all_serivces_slot = DB::table('services')->where('id',$request_service)->get();
                    
                    foreach($all_serivces_slot as $value){
                      $all_serivces_slot = $value->availableslot;
                     
                    }
                
                    $appointment ->appointment_availableslot = $all_serivces_slot-1;
                    
                  }





                    $appointment_slot = $request ->input ('available_slot');
                    $minus = $appointment_slot -1;
                    // $appointment_slot ->availableslot = 4;
                    $appointment->save();
                    appointments::where("appointment_date",$appointmentDate)->where("service_id",$request_service)->update(['appointment_availableslot' => $minus]);
                 
                    // $appointment_slot->update();
                    // $kk = "may laman";
                  
              } else {
                // $this->$validDate = "no";
            
                $all_serivces_slot = DB::table('services')->where('id',$request_service)->get();
                foreach($all_serivces_slot as $value){
                  $all_serivces_slot = $value->availableslot;
                  
                }
                  $appointment ->appointment_availableslot = $all_serivces_slot;
                  $appointment_slot = $request ->input ('available_slot');
                  $minus = $appointment_slot -1;
                  $appointment->save();
                  appointments::where("appointment_date",$appointmentDate)
                  ->update(['appointment_availableslot' => $minus]);
                  
              }
              // dd($minus);
          
        
          if(Auth::User()->account_type=='admin'){
            return view('services');
            }else{
              return redirect()->route('calendar')->with('success', "Appointment Created");
            }
    
       
        }
      } else {

        if(Auth::User()->account_type=='admin'){
          return view('services');
          }else{
            return redirect()->route('calendar')->with('warning', "Please insert a service");
          }
      }


  }
    public function cancel_appointment($id){
        $user_id = appointments::find($id);
        // $service_id = User::find($id);

        return response()->json([
              'status'=>200,
              'user_id'=> $user_id,
      
        ]);
    }

  public function get_appointmentDate($date,$id){

      $today = \Carbon\Carbon::today()->format('Y/m/d');
     $appointment_date = \Carbon\Carbon::parse($date)->format('Y/m/d');
     
      if($appointment_date < $today){
        $validDate = "no";
      }else{
        $validDate = "yes";
      }
    
      $date1 = DB::table('appointments')->where('appointment_date',$date)->where('service_id',$id)->get();
        $allservicesslot = DB::table('services')->sum('availableslot');
        $individualserviceslot= DB::table('services')->get();
    
        return response()-> json([
          'validDate'=> $validDate,
          'servicesslot'=>$allservicesslot,
          'appointmentslot'=>$date1,
          'individualserviceslot'=> $individualserviceslot,
         
        ]);
  }

  public function get_appointmentDate_reschedule($appointment_id,$new_appointment_date){

    $today = \Carbon\Carbon::today()->format('Y/m/d');

    $service_id = DB::table('appointments')->where('appointment_id',$appointment_id)->where('appointment_status',"pending")->get();

    foreach ($service_id as $value) {
      $service_id = $value->service_id;
 
   
    }
   
   $appointment_date = \Carbon\Carbon::parse($new_appointment_date)->format('Y/m/d');
   
   
    if($appointment_date < $today){
      $validDate = "no";
    }else{
      $validDate = "yes";
    }
  
    $date1 = DB::table('appointments')->where('appointment_date',$appointment_date)->where('service_id',$service_id)->where('appointment_status',"pending")->get();

      // $allservicesslot = DB::table('services')->sum('availableslot');
    $individualserviceslot= DB::table('services')->get();
  
      return response()-> json([
        'validDate'=> $validDate,
        // 'servicesslot'=>$allservicesslot,
        'today'=>$today,
        'appointmentslot'=>$date1,
        'individualserviceslot'=> $individualserviceslot,
       
      ]);
}

  public function get_available_slot($id){

    $today = \Carbon\Carbon::today()->format('Y-m-d');

  
  $date1 = DB::table('appointments')->where('appointment_id',$id)->get();

  // foreach ($date1 as $value) {

  //     $date = $value->appointment_date;
  //     dd($date)
  // }

  
      // $allservicesslot = DB::table('services')->sum('availableslot');
      // $individualserviceslot= DB::table('services')->get();

  
      return response()-> json([
        // 'validDate'=> $validDate,
        // 'servicesslot'=>$allservicesslot,
        'date'=>$date1,
        'today'=>$today,
        // 'individualserviceslot'=> $individualserviceslot,
       
      ]);
}

public function reschedule_appointment(Request $request){

  $appointment_id =$request->input('appointment_id');
  $new_appointment_date =$request->input('new_appointment_date');
  $new_appointment_slot =$request->input('available_slot_reschedule');
  $service_id =$request->input('service_id');




  $old_appointment_date =$request->input('old_appointment_date');
  // $expire = Carbon::now()->addHours(48);
  $today = \Carbon\Carbon::today()->format('Y-m-d');


      if($old_appointment_date < $today){
        appointments::where('appointment_date',$old_appointment_date)->where('service_id',$service_id )->update(['appointment_date' => 0]);

      }else{
        if($new_appointment_date != $old_appointment_date){
  
          $new = appointments::where('appointment_date',$new_appointment_date)->where('appointment_status',"pending")->where('service_id',$service_id )->get();
    
        //walang existing na date
          if($new->isEmpty()){
              appointments::where('appointment_id',$appointment_id)->where('appointment_status',"pending")->where('service_id',$service_id )->update(['appointment_date' => $new_appointment_date, 'appointment_availableslot'=> $new_appointment_slot-1]);
            
          }else{

            appointments::where('appointment_date',$old_appointment_date)->where('appointment_status',"pending")->where('service_id',$service_id )->where('appointment_id',$appointment_id)->update(['appointment_date' => $new_appointment_date,'appointment_availableslot'=> $new_appointment_slot-1] );
            
            appointments::where('appointment_date',$new_appointment_date)->where('appointment_status',"pending")->where('service_id',$service_id )->update(['appointment_availableslot'=> $new_appointment_slot-1]);
          
          }

        }else{
          appointments::where('appointment_date',$new_appointment_date)->where('appointment_status',"pending")->where('service_id',$service_id )->update(['appointment_date' => $old_appointment_date, 'appointment_availableslot'=> $new_appointment_slot-1]);
        }
        

      }

  return redirect()->back()->with('success', 'Appointment sucessfully rescheduled');

}
    
  public function created_appointment(Request $request){
    $id = $request ->input ('calcel_id');
    $canceled_appointment_id = appointments::find($id);
    $service = $request ->input ('service');

  
    if($request ->input ('cancel_message') == null){
      $message ="Your " . $service . " Appointment has been canceled!";
    }else{
      $message = $request->input('cancel_message');
    }
    $canceled_appointment_id ->appointment_message = $message;
    $canceled_appointment_id->update();
  
// ------------------------------------------------------------------------------------
    $recipient = $request->input('user_phoneNo');

    //temporary disabled message function
      // $this->sendMessage($message, $recipient);


    // ------------------------------------------------------------------------------------
    if(Auth::User()->account_type=='admin'){
      return redirect()->back()->with('success', 'Notification Sent!');
    }else{
      return redirect()->route('login');
    }
  
  }  


    public function canceled_appointment(Request $request){
      $id = $request ->input ('calcel_id');
      $canceled_appointment_id = appointments::find($id);
      $service = $request ->input ('service');

    
      if($request ->input ('cancel_message') == null){
        $message ="Your " . $service . " Appointment has been canceled!";
      }else{
        $message = $request->input('cancel_message');
      }
      $canceled_appointment_id ->appointment_message = $message;
      $canceled_appointment_id ->appointment_status = "canceled";
      $canceled_appointment_id->update();
    
// ------------------------------------------------------------------------------------
      $recipient = $request->input('user_phoneNo');

      //temporary disabled function
        // $this->sendMessage($message, $recipient);


      // ------------------------------------------------------------------------------------
      if(Auth::User()->account_type=='admin'){
        return redirect()->back()->with('success', 'Notification Sent!');
      }else{
        return redirect()->route('login');
      }
    
    }  

    public function sendCustomMessage(Request $request)
    {
        // $validatedData = $request->validate([
        //     'users' => 'required|array',
        //     'body' => 'required',
        // ]);

        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Notification Sent!"]);
    }
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients Number of recipient
     */
    
    private function sendMessage($message, $recipient)
    {
      
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipient, ['from' => $twilio_number, 'body' => $message]);
    }


    public function service_appointment($id){
      $service_id = appointments::find($id);
      // $service_id = User::find($id);

      return response()->json([
            'status'=>200,
            'service_id'=> $service_id,
    
      ]);
  }


  public function delete_scheduled_appointment (Request $request){

    $id = $request ->input ('delete_id');
    $appointment_delete= appointments::find($id);
    
    $appointment_delete->delete();

    if(Auth::User()->account_type=='admin'){
      return redirect()->back()->with('danger', 'Successfully Deleted');
    }else{
    return redirect()->route('calendar');
    }

  }
  
    
}