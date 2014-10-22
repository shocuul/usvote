<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('users','UsersController');
Route::get('/','UsersController@index');
Route::get('competitions/manage/{id}',array('as'=>'competitions.manage','uses'=>'CompetitionsController@manage'));
Route::get('competitions/manage/{idCompetition}/student/{idStudent}',array('as'=>'competitions.addstudent','uses'=>'CompetitionsController@addstudent'));
Route::get('competitions/manage/{idCompetition}/destroystudents/{idStudent}',array('as'=>'competitions.deletestudent','uses'=>'CompetitionsController@deletestudent'));
Route::get('students/{idStudent}/competitiondata/{idCompetition}',array('as'=>'students.adddata','uses'=>'CompetitionsController@addcompetitiondata'));
Route::post('students/{idStudent}/{idCompetition}',array('as'=>'student.savedata','uses'=>'CompetitionsController@savecompetitiondata'));
Route::resource('users','UsersController');
Route::resource('competitions','CompetitionsController');
