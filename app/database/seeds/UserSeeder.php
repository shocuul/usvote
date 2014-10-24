<?php
/**
 * Created by PhpStorm.
 * User: denethiel
 * Date: 19/10/14
 * Time: 19:14
 */

class UserSeeder extends DatabaseSeeder{
    public function run(){
        $users = [[
            'firstname'=>'Administrador',
            'lastname'=>'US',
            'email'=>'us@us.mx',
            'password'=>Hash::make('online'),
            'admin'=>true,
            'matricula'=>"3333333333"
        ],[
            'firstname'=>'Jose David',
            'lastname'=>'Pacheco Valedo',
            'email'=>'shocuul@live.com',
            'password'=>Hash::make('by45nt5k4n'),
            'admin'=>true,
            'matricula'=>"1111111111"
        ]];
        foreach ($users as $user) {
            User::create($user);
        }
        $faker = Faker\Factory::create('es_ES');
        for($i=0;$i<50;$i++){
            $user = new User;
            $user->firstname = $faker->firstName;
            $user->lastname = $faker->lastName;
            $user->email = $faker->email;
            $user->matricula = $faker->randomNumber(8);
            $user->password = Hash::make($faker->userName);
            $user->save();
            $student = new Student;
            $student->facultad = $faker->city;
            $user->student()->save($student);
        }

        for($i=0;$i<50;$i++){
            $user = new User;
            $user->firstname = $faker->firstName;
            $user->lastname = $faker->lastName;
            $user->email = $faker->email;
            $user->matricula = $faker->randomNumber(8);
            $user->password = Hash::make($faker->userName);
            $user->save();
            $employee = new Employee;
            $employee->cargo = $faker->company;
            $user->employee()->save($employee);
        }
    }
}