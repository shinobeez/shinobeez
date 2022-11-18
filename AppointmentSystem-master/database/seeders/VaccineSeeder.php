<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vaccine')->insert([
            'id' => "1",
            'service_id'=> "1",
            'category'=> "kids",
            'category_availability'=> "Yes",

            // 'id' => "1",
            // 'service_id'=> "2",
            // 'category'=> "covid",
            // 'category_availability'=> "Yes",

            // 'id' => "1",
            // 'service_id'=> "3",
            // 'category'=> "others",
            // 'category_availability'=> "Yes",


          
        ]);
    }
}
