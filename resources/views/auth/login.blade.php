@extends('/layouts.main')

@section('content')    
   
<div class="col-sm-5">
    <h1>Login</h1>


    <form method="POST" action="/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>      

        <div class="form-group">
            <button type="submit" class="btn btn-default">Sign In</button>
        </div>
    </form>
</div>
@stop