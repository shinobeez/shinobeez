<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\appointments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class QrCodeController extends Controller
{
    function index($kk){
        if(Auth::User()->account_type=='admin'){
            return view ('scanner');
            }else{
                $user_id = appointments::find($kk);
                $qrcode = response()->json(['user_id'=> $user_id,]);
              return  $qrcode;
        }
        
    }
}
