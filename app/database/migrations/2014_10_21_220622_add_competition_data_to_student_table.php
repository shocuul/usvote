<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompetitionDataToStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
		{
			//
            $table->string('imagen');
            $table->string('edad');
            $table->longText('descripcion');
		});
        Schema::table('competitions',function(Blueprint $table){
            $table->integer('inscritos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function(Blueprint $table)
		{
			//
            $table->dropColumn(array('imagen','edad','descripcion'));
		});
        Schema::table('competitions',function(Blueprint $table){
            $table->dropColumn('inscritos');
        });
	}

}
