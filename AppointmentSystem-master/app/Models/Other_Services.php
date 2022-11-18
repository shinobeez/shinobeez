<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other_Services extends Model
{
    use HasFactory;

    protected $table ="other_services";

    protected $fillable = [
        'id', 
        'service_id',
        'other_services',  

    ];
}
