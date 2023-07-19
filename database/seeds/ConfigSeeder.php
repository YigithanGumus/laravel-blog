<?php

use Illuminate\Database\Seeder;
use 

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'title'=>'Codeigniter Hocası',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
