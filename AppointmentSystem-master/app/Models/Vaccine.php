<?php

namespace App\Models;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Vaccine extends Model
{
    use HasFactory;
    protected $table ="vaccine";

    protected $fillable = [
        'id',
        'service_id',
        'category_id',
        'vaccine_type',


    ];

    public function category() {
        return $this->belongsToMany(Category::class);
    }
}
