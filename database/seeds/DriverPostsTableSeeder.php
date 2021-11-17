<?php

use Illuminate\Database\Seeder;

class DriverPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('driver_posts')->truncate();
        factory(App\DriverPost::class, 10)->create();
    }
}
