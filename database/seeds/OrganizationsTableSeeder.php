<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('savings_organizations')->insert([
            ['name' => "Post Office"]
            , ['name' => "Bangladesh Bank"]
            , ['name' => "DBBL"]
            , ['name' => "EBL"]
        ]);
    }
}
