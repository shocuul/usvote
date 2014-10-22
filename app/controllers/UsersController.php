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
		if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password')))){
			return Redirect::to('users/dashboard')->with('message','You are now logged in!');
		}else{
			return Redirect::to('users/login')
				->with('message','You username/password combination was incorrect')
				->withInput();
		}
	}

	public function getLogout() {
    Auth::logout();
    return Redirect::to('users/login')->with('message', 'Your are now logged out!');
}

	public function getDashboard(){
		$this->layout->content = View::make('users.dashboard');
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
		    $user->password = Hash::make(Input::get('password'));
            $user->save();
            if(Input::get('type')=='student'){
                $student = new Student;
                $student->matricula = Input::get('matricula');
                $student->facultad = Input::get('type_description');
                $user->student()->save($student);
            }else{
                $employee = new Employee;
                $employee->matricula = Input::get('matricula');
                $employee->cargo = Input::get('type_description');
                $user->employee()->save($employee);
            }


    		return Redirect::to('users/')->with('message', 'Thanks for registering!');
		} else {
		    return Redirect::to('users/register')->with('message', 'Usted tiene los siguientes errores')->withErrors($validator)->withInput();
		}
	}
}
 ?>