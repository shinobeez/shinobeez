<?php

namespace App\Models;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table ="categories_vaccine";

    protected $fillable = [
    
        'id',
        'service_id ',
        'category',



    ];
public function vaccine(){
    return this->belongsToMany(Vaccine::class);
}

}
