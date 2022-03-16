<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        $adminRole = Role::whereName('admin')->first();

        $admin = new User();
        $admin->first_name = "Admin";
        $admin->last_name = "Admin";
        $admin->email = "admin@test.com";
        $admin->password = bcrypt('password');
        $admin->save();

        $admin->attachRole($adminRole);

        $studentRole = Role::whereName('student')->first();
        $student = new User();
        $student->first_name = "Student";
        $student->last_name = "Student";
        $student->email = "student@test.com";
        $student->password = bcrypt('password');
        $student->save();

        $student->attachRole($studentRole);

        //generate other 50 students

        //User::factory()->count(50)->create();


    }
}
