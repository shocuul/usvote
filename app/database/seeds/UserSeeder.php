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
            'password'=>Hash::make('online')
        ],[
            'firstname'=>'Jose David',
            'lastname'=>'Pacheco Valedo',
            'email'=>'shocuul@live.com',
            'password'=>Hash::make('by45nt5k4n')
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
            $user->password = Hash::make($faker->userName);
            $user->save();
            $student = new Student;
            $student->matricula = $faker->randomNumber(8);
            $student->facultad = $faker->city;
            $user->student()->save($student);
        }

        for($i=0;$i<50;$i++){
            $user = new User;
            $user->firstname = $faker->firstName;
            $user->lastname = $faker->lastName;
            $user->email = $faker->email;
            $user->password = Hash::make($faker->userName);
            $user->save();
            $employee = new Employee;
            $employee->matricula = $faker->randomNumber(8);
            $employee->cargo = $faker->company;
            $user->employee()->save($employee);
        }
    }
}