<?php
/*
 * Competition Table Model
 *
 * Campos:
 *  id
 *  name
 *  fecha_inicio
 *  fecha_final
 *
 *
 *
 */

class Competition extends Eloquent{
    protected $table = 'competitions';

    protected $guarded = array('id');
    protected $fillble = array('name','fecha_inicio','fecha_final');

    public static $rules = array(
        'name'=>'required|min:5',
        'fecha_inicio'=>'required',
        'fecha_final'=>'required'
    );

    public function students(){
        return $this->belongsToMany('Student');
    }
}