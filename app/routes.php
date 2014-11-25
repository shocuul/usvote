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


Route::get('/','UsersController@index');
Route::get('resultados/',array('before'=>'auth','as'=>'competitions.resultados','uses'=>'CompetitionsController@resultados'));
Route::get('admin-resultados/',array('before'=>'auth','as'=>'competitions.adminresultados','uses'=>'CompetitionsController@adminresultados'));
Route::get('users/show/{id}',array('before'=>'auth','as'=>'users.show','uses'=>'UsersController@show'));
Route::match(array('DELETE'),'users/delete/{id}',array('before'=>'auth','as'=>'users.delete','uses'=>'UsersController@borrar'));
Route::get('vote/{idStudent}/{idCompetition}',array('before'=>'auth','as'=>'competitions.vote','uses'=>'CompetitionsController@vote'));
Route::get('competitions/manage/{id}',array('before'=>'auth','as'=>'competitions.manage','uses'=>'CompetitionsController@manage'));
Route::get('competitions/manage/{idCompetition}/student/{idStudent}',array('before'=>'auth','as'=>'competitions.addstudent','uses'=>'CompetitionsController@addstudent'));
Route::get('competitions/manage/{idCompetition}/destroystudents/{idStudent}',array('before'=>'auth','as'=>'competitions.deletestudent','uses'=>'CompetitionsController@deletestudent'));
Route::get('students/{idStudent}/competitiondata/{idCompetition}',array('before'=>'auth','as'=>'students.adddata','uses'=>'CompetitionsController@addcompetitiondata'));
Route::post('students/{idStudent}/{idCompetition}',array('before'=>'auth','as'=>'student.savedata','uses'=>'CompetitionsController@savecompetitiondata'));
//Route::resource('users','UsersController');
Route::get('competition/edit/{id}/data/{idCompetition}',array('before'=>'auth','as'=>'competition.editdata','uses'=>'CompetitionsController@editcompetitiondata'));
Route::patch('competition/updatedata/{id}/{idCompetition}',array('before'=>'auth','as'=>'competition.updatedata','uses'=>'CompetitionsController@updatecompetitiondata'));
Route::resource('competitions','CompetitionsController');
Route::controller('users','UsersController');
