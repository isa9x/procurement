<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
	    $role_viewer  = Role::where('name', 'viewer')->first();
	    
	    $admin = new User();
	    $admin->name = 'Hengki Tarnado';
	    $admin->email = 'Hengky@kmp.kiranamegatara.com';
	    $admin->password = bcrypt('admin');
	    $admin->save();
	    $admin->roles()->attach($role_admin);
	   
	    $viewer = new User();
	    $viewer->name = 'Nursadono';
	    $viewer->email = 'nursadono@kmp.kiranamegatara.com';
	    $viewer->password = bcrypt('nursadono');
	    $viewer->save();
	    $viewer->roles()->attach($role_viewer);
	}
}
