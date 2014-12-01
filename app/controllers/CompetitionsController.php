<?php

class CompetitionsController extends HomeController{

    protected $layout = "layouts.main";

    /*
    Simple CRUD Competition
    */

    public function index(){
        $this->layout->content = View::make('competitions.index',['competitions'=>Competition::all()]);
    }

    public function create(){
        $this->layout->content = View::make('competitions.create');
    }


    public function store(){
        $input = Input::all();
        $validator = Validator::make($input, Competition::$rules);
        if($validator->passes()){
            Competition::create($input);
            return Redirect::route('competitions.index');
        }

        return Redirect::route('competitions.create')->withInput()->withErrors($validator)->with('message','Usted tiene los siguientes errores');

    }

    public function show($id){
        $competition = Competition::find($id);
        if(is_null($competition)){
            return Redirect::route('competitions.index');
        }
        $this->layout->content = View::make('competitions.show',compact('competition'));
    }

    public function edit($id){
        $competition = Competition::find($id);
        if(is_null($competition)){
            return Redirect::route('competitions.index');
        }
        $this->layout->content = View::make('competitions.edit',compact('competition'));

    }

    /**
     * @param $id
     * Manage View para agregar nuevos alumnos ala competencia.
     */
    public function manage($id){
        $competition = Competition::find($id);
        if(is_null($competition)){
            return Redirect::route('competitions.index');
        }
        //review
        $students = Student::paginate(15);
        //$students = array_except(Student::all(),$competition->students)->paginate(15);
        //$students = Student::whereHas('competitions',function($q){
          //  $q->where('competition_id','=',$competition->id);
        //})->paginate(15);
        $this->layout->content = View::make('competitions.manage',compact('competition','students'));

    }

    /**
     * @param $idCompetition id de la competencia
     * @param $idStudent id del estudiante
     * @return
     * Agrega un alumno a una competencia.
     */
    public function addstudent($idCompetition,$idStudent){
        $competition = Competition::find($idCompetition);
        if(($competition->inscritos)>=11){
            return Redirect::route('competitions.manage',$idCompetition)->with('message','Limite alcanzado');
        }
        $student = Student::find($idStudent);
        $competition->inscritos = $competition->inscritos + 1;
        $competition->save();
        $competition->students()->save($student);
        //$student->competitions()->attach($competition->id,array('votes'=>'50'));

        return Redirect::route('competitions.manage',$idCompetition);
    }

    /**
     * @param $idStudent
     * @param $idCompetition
     * @return mixed
     *
     * Registra el voto
     */
    public function vote($idStudent,$idCompetition){
        $currentvotes = DB::table('competition_student')->where(array('competition_id'=>$idCompetition,'student_id'=>$idStudent))->increment('votes',1);
        if($currentvotes){
            Auth::logout();
            return Redirect::to('/')->with('message', 'Gracias por su voto');
        }else{
            return Redirect::to('users/dashboard')->with('message','Ah ocurrido un error');

        }

    }

    /**
     * Muestra los resultados de la votacion
     */
    public function resultados()
    {
        $competitions = Competition::finalizado()->get();
        $lugares = 1;
        $this->layout->content = View::make('competitions.result',compact('competitions','lugares'));
    }

    public function adminresultados(){

        $competencia = Competition::first()->fecha_final;

        $jshelper = 1;

        $finalizado = Competition::finalizado()->get();

        $this->layout->content = View::make('competitions.adminresult',compact('competencia','jshelper','finalizado'));
    }

    /**
     * @param $id
     * @param $idCompetition
     * Edita la informacion del alumno para competencias
     */
    public function editcompetitiondata($id,$idCompetition){
        $student = Student::find($id);
        $this->layout->content = View::make('competitions.editdata',compact('student','idCompetition'));
    }


    /**
     * @param $idCompetition
     * @param $idStudent
     * @return mixed
     *
     * Elimina estudiantes de la competencia
     */
    public function deletestudent($idCompetition,$idStudent){
        $competition = Competition::find($idCompetition);
        $student = Student::find($idStudent);
        $competition->inscritos = $competition->inscritos - 1;
        $competition->save();
        $competition->students()->detach($student->id);
        return Redirect::route('competitions.manage',$idCompetition);
    }

    /**
     * @param $idStudent
     * @param $idCompetition
     *
     * Muestra la vista para agregar informacion de la competencia al alumno
     * @imagen
     * @edad
     * @descripcion
     */
    public function addcompetitiondata($idStudent,$idCompetition){
        $this->layout->content = View::make('competitions.enterdata',compact('idStudent','idCompetition'));
    }

    /**
     * @param $idStudent
     * @param $idCompetition
     * @return mixed
     *
     * Salva la informacion de la competencia al alumno
     * @imagen
     * @edad
     * @descripcion
     */
    public function savecompetitiondata($idStudent,$idCompetition){
        $student = Student::find($idStudent);
        $destinationPath = '';
        $filename = '';
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $destinationPath = public_path(). '/images';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSucess = $file->move($destinationPath,$filename);
            $student->imagen = '/images/' . $filename;
            $student->edad = Input::get('edad');
            $student->descripcion = Input::get('descripcion');
            $student->save();
        }
        return Redirect::route('competitions.manage',$idCompetition);

    }

    /**
     * @param $id
     * @param $idCompetition
     * @return mixed
     * Actualiza los datos de la competencia
     * @imagen
     * @edad
     * @descripcion
     */
    public function updatecompetitiondata($id,$idCompetition){
        $student = Student::find($id);
        $student->edad = Input::get('edad');
        $student->descripcion = Input::get('descripcion');
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $destinationPath = public_path(). '/images';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSucess = $file->move($destinationPath,$filename);
            $student->imagen = '/images/'. $filename;
        }
        $student->save();

        return Redirect::route('competitions.manage',$idCompetition);

    }

    /**
     * @param $id
     * @return mixed
     * CRUD update
     */
    public function update($id){
        $input = Input::all();
        $validator = Validator::make($input,Competition::$rules);
        if($validator->passes()){
            $competition = Competition::find($id);
            $competition->update($input);
            return Redirect::route('competitions.show',$id);
        }
        return Redirect::route('competitions.edit',$id)->with('message','Usted tiene los siguientes errores.')->withErrors($validator)->withInput();
    }

    /**
     * @param $id
     * @return mixed
     * CRUD destroy
     */
    public function destroy($id){
        Competition::find($id)->delete();
        return Redirect::route('competitions.index');
    }
}