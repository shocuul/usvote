<?php 
/**
* 
*/
class UsersController extends BaseController
{
	public function __construct(){
		$this->beforeFilter('csrf',array('on'=>'post'));
		$this->beforeFilter('auth',array('except'=>array('getLogin','postSignin','index')));
	}
	protected $layout = "layouts.main";
	public function getRegister(){
		$this->layout->content = View::make('users.register');
	}


    /**
     * @param $id
     * Funcion para mostrar usuarios
     */
    public function getMostrar($id){
        $user = User::find($id);
        if(is_null($user)){
            return Redirect::back();
        }
        if(is_null($user->student)){
            $user_type = 'Docente';
        }else {
            $user_type = 'Alumno';
        }
        $this->layout->content = View::make('users.show',compact('user','user_type'));
    }


    /**
     * @param $id
     * Funcion para editar un usuario
     */
    public function getEdit($id){
        $user = User::find($id);
        if(is_null($user)){
            Redirect::back();
        }
        if(is_null($user->student)) {
            $user_type = 'Docente';
        }else {
            $user_type = 'Alumno';
        }
        $this->layout->content = View::make('users.edit',compact('user','user_type'));
    }

    /**
     * @param array $parameters
     * Funcion para redireccionar al index url invalidas bajo /users/
     */
    public function missingMethod($parameters = array()){
        $this->layout->content = View::make('users.index')->with('message','URL Incorrecta');
    }

    /**
     * @param $id
     * @return mixed
     *
     * Funcion para Actualizar la informacion del usuario
     */
    public function patchUpdate($id){
        $user = User::find($id);
        $user->firstname = Input::get('firstname');
        $user->lastname = Input::get('lastname');
        $user->email = Input::get('email');
        $user->matricula = Input::get('matricula');
        $user->save();
        return Redirect::to('users/mostrar/'.$id)->with('message','Informacion Actualizada');
    }

    /**
     * @return dashboard
     * Inicio de Sesion
     */
    public function postSignin(){
		if(Auth::attempt(array('matricula'=>Input::get('matricula'),'password'=>Input::get('password')))){
			return Redirect::to('users/dashboard')->with('message','You are now logged in!');
		}else{
			return Redirect::to('users/login')
				->with('message','Su matricula y/o contraseña son incorrectas.')
				->withInput();
		}
	}

    /**
     * @param $id
     * @return a lista de usuarios o empleados segun el caso
     *
     * Borrar usuario
     */
    public function borrar($id){
        if(is_null(User::find($id)->student)){
            $url = 'users/employees/';
        }else{
            $url = 'users/students/';
        }
        User::find($id)->delete();
        return Redirect::to($url)->with('message','Usuario Eliminado.');
    }

    /**
     * @return mixed
     * Cerrar Sesion
     */
    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login')->with('message', 'Sesion cerrada correctamente.');
    }

    /**
     *Muestra pantalla de login
     */
    public function getLogin(){
        $this->layout->content = View::make('users.login');
    }


    /*
     * Index de la pagina
     */

    public function index(){

        $this->layout->content = View::make('users.index');
    }


    /**
     *Pantalla de votacion
     */
    public function getDashboard(){
        $competitions = Competition::where('fecha_inicio','<',date("Y-m-d"))->where('fecha_final','>',date("Y-m-d"))->get();
		$this->layout->content = View::make('users.dashboard',compact('competitions'));
	}


    /**
     *Muestra estudiantes
     */
    public function getStudents(){
        $this->layout->content = View::make('users.student',['students'=>Student::paginate(15)]);
    }

    /**
     *Muestra empleados
     */
    public function getEmployees(){
        $this->layout->content = View::make('users.employee',['employees'=>Employee::paginate(15)]);
    }


    /**
     * @return Usuario
     * Crea un nuevo Usuario
     */
    public function postCreate(){
		$validator = Validator::make(Input::all(), User::$rules);
		if (($validator->passes())&&(Input::get('type')!='none')) {
		    $user = new User;
		    $user->firstname = Input::get('firstname');
		    $user->lastname = Input::get('lastname');
		    $user->email = Input::get('email');
            $user->matricula = Input::get('matricula');
		    $user->password = Hash::make(Input::get('password'));
            $user->save();
            if(Input::get('type')=='student'){
                $student = new Student;
                $student->facultad = Input::get('type_description');
                $user->student()->save($student);
                return Redirect::to('users/students/')->with('message','Alumno creado correctamente');
            }else{
                $employee = new Employee;
                $employee->cargo = Input::get('type_description');
                $user->employee()->save($employee);
                return Redirect::to('users/employees/')->with('message','Docente creado correctamente');
            }
		} else {
		    return Redirect::to('users/register')->with('message', 'Usted tiene los siguientes errores')->withErrors($validator)->withInput();
		}
	}
}
 ?>