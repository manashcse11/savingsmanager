<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('savings_status')->insert([
            ['name' => "Running"]
            , ['name' => "Matured"]
        ]);
    }
}
