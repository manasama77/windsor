<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(10)->create();
        Admin::create([
            'name'     => 'Adam PM',
            'email'    => 'adam.pm77@gmail.com',
            'password' => bcrypt("adam"),
        ]);
    }
}
