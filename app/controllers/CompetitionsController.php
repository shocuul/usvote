<?php

class CompetitionsController extends HomeController{

    protected $layout = "layouts.main";

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

    public function manage($id){
        $competition = Competition::find($id);
        if(is_null($competition)){
            return Redirect::route('competitions.index');
        }
        $students = Student::paginate(15);
        $this->layout->content = View::make('competitions.manage',compact('competition','students'));

    }

    public function addstudent($idCompetition,$idStudent){
        $competition = Competition::find($idCompetition);
        if(($competition->inscritos)>=11){
            return Redirect::route('competitions.manage',$idCompetition)->with('message','Limite alcanzado');
        }
        $student = Student::find($idStudent);
        $competition->inscritos = $competition->inscritos + 1;
        $competition->save();
        $competition->students()->save($student);
        return Redirect::route('competitions.manage',$idCompetition);
    }

    public function deletestudent($idCompetition,$idStudent){
        $competition = Competition::find($idCompetition);
        $student = Student::find($idStudent);
        $competition->inscritos = $competition->inscritos - 1;
        $competition->save();
        $competition->students()->detach($student->id);
        return Redirect::route('competitions.manage',$idCompetition);
    }

    public function addcompetitiondata($idStudent,$idCompetition){
        $this->layout->content = View::make('competitions.enterdata',compact('idStudent','idCompetition'));
    }

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

    public function destroy($id){
        Competition::find($id)->delete();
        return Redirect::route('competitions.index');
    }
}