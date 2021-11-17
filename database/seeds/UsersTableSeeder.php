<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$user = new User;
        $param = [
            'name' => 'Ibuki',
            'age' => 21,
            'email' => 'Ibuki@gmail.com',
            'password' => 'narukawa',
        ];
        $user->fill($param)->save();*/
        
        DB::table('users')->truncate();
        factory(App\User::class, 10)->create();
    }
}
