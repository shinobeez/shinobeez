<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesVaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_vaccine')->insert([
            // 'id' => "1",
            // 'service_id'=> "1",
            // 'category'=> "kids",
            // 'category_availability'=> "Yes"

            // 'id' => "2",
            // 'service_id'=> "1",
            // 'category'=> "covid",
            // 'category_availability'=> "Yes",

            'id' => "3",
            'service_id'=> "1",
            'category'=> "others",
            'category_availability'=> "Yes",
        ]);
    }
}
