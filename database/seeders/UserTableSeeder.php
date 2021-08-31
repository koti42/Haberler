<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mehmet',
            'email' => 'mehmet@mehmetkucukcelebi.com.tr',
            'role'=>'admin',
            'password' => bcrypt('123456'),

        ]);
        User::create([
            'name' => 'editor',
            'email' => 'editor@editor.com',
            'role'=>'editor',
            'password' => bcrypt('123456'),

        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'role'=>'user',
            'password' => bcrypt('123456'),

        ]);
    }
}
