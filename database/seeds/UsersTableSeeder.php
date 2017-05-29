<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'lastname' => 'do Sistema',
            'email' => 'kenned123@gmail.com',
            'password' => bcrypt('@Admin'),
            'is_admin' => 1
        ]);
    }
}
