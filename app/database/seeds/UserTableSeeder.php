<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('employees')->delete();
        DB::table('members')->delete();


        $this->createAdmin();

        $this->createEmployee();

        $this->createMember();
    }

    public function createAdmin()
    {
        $admin = Employee::create(array(
            'first_name'            => 'Iftekher',
            'last_name'             => 'Sunny',
            'age'                   => 23,
            'gender'                => 'Male',
            'DOB'                   => Carbon::today(),
            'present_address'       => 'Present address .....',
            'permanent_address'     => 'Permanent address ...',
            'city'                  => 'Chittagong',
            'state'                 => 'state ....',
            'country'               => 'Bangladesh',
            'mobile_no'             => '+8801800000000',
            'email'                 => 'admin@gmail.com',
            'created_by'            => 'Developer'
        ));

        $user = User::create(array(
            'username' 			=>'admin',
            'password' 			=> Hash::make('admin'),
            'user_level' 		=> 'admin123',
            'email' 			=> 'admin@gmail.com',
            'password_tmp' 		=> '',
            'activation_code' 	=> '',
            'active'			=> 1,
            'remember_token'    => '',
            'details_id'        => $admin->id
        ));

        // generate random code and password
        $password 		    = str_random(10);
        $code 			    = str_random(60);
        $newHashPassword	= Hash::make($password);


        // Save new password and code
        $user->password_tmp 		= $newHashPassword;
        $user->activation_code 		= $code;
        $user->save();
    }

    public function createEmployee()
    {
        $employee = Employee::create(array(
            'first_name'            => 'Iftekher',
            'last_name'             => 'Sunny',
            'age'                   => 23,
            'gender'                => 'Male',
            'DOB'                   => Carbon::today(),
            'present_address'       => 'Present address .....',
            'permanent_address'     => 'Permanent address ...',
            'city'                  => 'Chittagong',
            'state'                 => 'state ....',
            'country'               => 'Bangladesh',
            'mobile_no'             => '+8801800000000',
            'email'                 => 'employee@gmail.com',
            'created_by'            => 'Developer'
        ));

        $user = User::create(array(
            'username' 			=>'employee',
            'password' 			=> Hash::make('employee'),
            'user_level' 		=> 'employee123',
            'email' 			=> 'employee@gmail.com',
            'password_tmp' 		=> '',
            'activation_code' 	=> '',
            'active'			=> 1,
            'remember_token'    => '',
            'details_id'        => $employee->id
        ));

        // generate random code and password
        $password 		    = str_random(10);
        $code 			    = str_random(60);
        $newHashPassword	= Hash::make($password);


        // Save new password and code
        $user->password_tmp 		= $newHashPassword;
        $user->activation_code 		= $code;
        $user->save();
    }

    public function createMember()
    {
        $member = Member::create(array(
            'first_name'            => 'Iftekher',
            'last_name'             => 'Sunny',
            'age'                   => 23,
            'gender'                => 'Male',
            'DOB'                   => Carbon::today(),
            'present_address'       => 'Present address .....',
            'permanent_address'     => 'Permanent address ...',
            'city'                  => 'Chittagong',
            'state'                 => 'state ....',
            'country'               => 'Bangladesh',
            'mobile_no'             => '+8801800000000',
            'email'                 => 'member@gmail.com',
            'created_by'            => 'Developer'
        ));

        $user = User::create(array(
            'username' 			=>'member',
            'password' 			=> Hash::make('member'),
            'user_level' 		=> 'member123',
            'email' 			=> 'member@gmail.com',
            'password_tmp' 		=> '',
            'activation_code' 	=> '',
            'active'			=> 1,
            'remember_token'    => '',
            'details_id'        => $member->id
        ));

        // generate random code and password
        $password 		    = str_random(10);
        $code 			    = str_random(60);
        $newHashPassword	= Hash::make($password);


        // Save new password and code
        $user->password_tmp 		= $newHashPassword;
        $user->activation_code 		= $code;
        $user->save();
    }

}