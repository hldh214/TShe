<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('coupons')->delete();
        
        \DB::table('coupons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '首单立减20!',
                'description' => '首单立减20!-desc',
                'amount' => 2000,
                'created_at' => '2017-10-21 14:54:19',
                'updated_at' => '2017-10-21 14:54:19',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}