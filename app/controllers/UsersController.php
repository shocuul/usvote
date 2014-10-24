<?php 
/**
* 
*/
class UsersController extends BaseController
{
	public function __construct(){
		$this->beforeFilter('csrf',array('on'=>'post'));
		$this->beforeFilter('auth',array('only'=>array('getDashboard')));
	}
	protected $layout = "layouts.main";
	public function getRegister(){
		$this->layout->content = View::make('users.register');
	}

	public function postSignin(){
		if(Auth::attempt(array('matricula'=>Input::get('matricula'),'password'=>Input::get('password')))){
			return Redirect::to('users/dashboard')->with('message','You are now logged in!');
		}else{
			return Redirect::to('users/login')
				->with('message','Su matricula y/o contraseña son incorrectas.')
				->withInput();
		}
	}

	public function getLogout() {
    Auth::logout();
    return Redirect::to('users/login')->with('message', 'Sesion cerrada correctamente.');
}

	public function getDashboard(){
        $competitions = Competition::all();
		$this->layout->content = View::make('users.dashboard',compact('competitions'));
	}

	public function getLogin(){
		$this->layout->content = View::make('users.login');
	}

    public function getStudents(){
        $this->layout->content = View::make('users.student',['students'=>Student::paginate(15)]);
    }

    public function getEmployees(){
        $this->layout->content = View::make('users.employee',['employees'=>Employee::paginate(15)]);
    }

    public function index(){

        $this->layout->content = View::make('users.index',['students'=>Student::paginate(15),'employees'=>Employee::paginate(15)]);
    }

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