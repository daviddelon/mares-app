<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mares')->delete();
        
        \DB::table('mares')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'longitude' => '4.0000000',
                'latitude' => '4.0000000',
                'created_at' => '2024-05-30 21:30:00',
                'updated_at' => '2024-05-30 21:30:00',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'longitude' => '3.7321700',
                'latitude' => '43.7982800',
                'created_at' => '2024-05-30 21:48:18',
                'updated_at' => '2024-06-04 21:38:54',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'longitude' => '3.7226300',
                'latitude' => '43.7689150',
                'created_at' => '2024-05-31 13:29:22',
                'updated_at' => '2024-06-04 21:37:24',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 3,
                'longitude' => '3.7285063',
                'latitude' => '43.7931370',
                'created_at' => '2024-05-31 13:30:08',
                'updated_at' => '2024-06-04 21:35:52',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'longitude' => '3.7936950',
                'latitude' => '43.8058076',
                'created_at' => '2024-06-10 22:15:02',
                'updated_at' => '2024-06-10 22:15:02',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'longitude' => '3.7298986',
                'latitude' => '43.7732282',
                'created_at' => '2024-06-10 22:16:36',
                'updated_at' => '2024-06-10 22:16:36',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'longitude' => '3.7318245',
                'latitude' => '43.7977525',
                'created_at' => '2024-06-10 22:18:55',
                'updated_at' => '2024-06-10 22:18:55',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'longitude' => '3.7152538',
                'latitude' => '43.7530184',
                'created_at' => '2024-06-10 22:19:31',
                'updated_at' => '2024-06-10 22:19:31',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 1,
                'longitude' => '3.7877619',
                'latitude' => '43.7599443',
                'created_at' => '2024-06-10 22:20:22',
                'updated_at' => '2024-06-10 22:20:22',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 1,
                'longitude' => '3.7274122',
                'latitude' => '43.7993303',
                'created_at' => '2024-06-12 21:36:57',
                'updated_at' => '2024-06-12 21:36:57',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 1,
                'longitude' => '3.7245798',
                'latitude' => '43.7261266',
                'created_at' => '2024-06-12 21:38:09',
                'updated_at' => '2024-06-12 21:38:09',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 1,
                'longitude' => '3.7352872',
                'latitude' => '43.7686998',
                'created_at' => '2024-06-12 21:38:51',
                'updated_at' => '2024-06-12 21:38:51',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'longitude' => '3.7919971',
                'latitude' => '43.8028981',
                'created_at' => '2024-06-12 21:39:24',
                'updated_at' => '2024-06-12 21:39:24',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 1,
                'longitude' => '3.7866139',
                'latitude' => '43.8170879',
                'created_at' => '2024-06-12 21:39:49',
                'updated_at' => '2024-06-12 21:39:49',
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 1,
                'longitude' => '3.7814882',
                'latitude' => '43.8146919',
                'created_at' => '2024-06-12 21:40:55',
                'updated_at' => '2024-06-12 21:40:55',
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 1,
                'longitude' => '3.7810296',
                'latitude' => '43.8146686',
                'created_at' => '2024-06-12 21:41:09',
                'updated_at' => '2024-06-12 21:41:09',
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 1,
                'longitude' => '3.7161657',
                'latitude' => '43.7969084',
                'created_at' => '2024-06-12 21:43:03',
                'updated_at' => '2024-06-12 21:43:03',
            ),
        ));
        
        
    }
}