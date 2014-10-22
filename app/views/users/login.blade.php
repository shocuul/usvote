{{ Form::open(array('url'=>'users/signin','class'=>'form-signin','role'=>'form')) }}
	<h2 class="form-signin-heading">Please login</h2>
	<div class="form-group">
	{{ Form::text('email',null,array('class'=>'form-control','placeholder'=>'Email Address')) }}
	{{ Form::password('password',array('class'=>'form-control','placeholder'=>'Password'))}}

	{{ Form::submit('Login',array('class'=>'btn btn-lg btn-primary btn-block'))}}
    </div>
	{{ Form::close() }}