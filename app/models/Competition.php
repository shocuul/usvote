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

    public function scopeFinalizado($query){
        return $query->where('fecha_final','<',date("Y-m-d"));
    }

    public function scopeNoDisponible($query){
        return $query->where('fecha_inicio','<',date("Y-m-d"));
    }

    public function scopeCurrent($query){
        with(clone $query)->where('fecha_final','<',date("Y-m-d"));
        with(clone $query)->where('fecha_inicio','>',date("Y-m-d"));
    }

    public function students(){
        return $this->belongsToMany('Student')->withPivot('votes');;
    }

    public function winner()
    {
        return $this->belongsToMany('Student')->withPivot('votes')->orderBy('votes','des')->take(3);;
    }
}