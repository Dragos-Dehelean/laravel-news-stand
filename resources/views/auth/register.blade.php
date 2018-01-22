@extends('/layouts.main')
@section('content')

<div class="col-md-5">
	<h2>Register</h2>

	{{ Form::open(['route' => 'auth.store']) }}		
		
		{{ csrf_field() }}

		<div class="form-group">
			{{ Form::label( 'name', 'Name' ) }}
			{{ Form::text( 'name', null, ['class' => 'form-control'] ) }}
		</div>

		<div class="form-group">
			{{ Form::label( 'email', 'Email' ) }}
			{{ Form::text( 'email', null, ['class' => 'form-control'] ) }}
		</div>
		<div class="form-group">
			{{ Form::label( 'password', 'Password' ) }}
			{{ Form::password('password', ['class' => 'form-control'] ) }}
		</div>
		<div class="form-group">
			{{ Form::submit( 'Register', ['class' => 'btn btn-success btn-block'] ) }}
		</div>


	{{ Form::close() }}

</div>

@stop