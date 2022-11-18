<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
    
            // 'id' => "1",
            // 'service'=> "vaccine",
            // 'availableslot'=> "10",
            // 'availability'=> "Yes",

            // 'id' => "2",
            // 'service'=> "medicine",
            // 'availableslot'=> "10",
            // 'availability'=> "Yes",

            'id' => "3",
            'service'=> "checkup",
            'availableslot'=> "10",
            'availability'=> "Yes",
          
        ]);
    }
}
