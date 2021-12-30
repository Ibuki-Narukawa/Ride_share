<?php

use Illuminate\Database\Seeder;

class CarpoolersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('carpoolers')->truncate();
        factory(App\Carpooler::class, 10)->create();
    }
}
