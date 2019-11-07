<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->name = 'Administrator';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->api_token = Str::random(30);
        $user->is_admin = true;
        $user->save();
    }
}
