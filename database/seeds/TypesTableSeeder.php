<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('savings_type')->insert([
            ['name' => "DPS"]
            , ['name' => "Sanchaypatra"]
        ]);
    }
}
