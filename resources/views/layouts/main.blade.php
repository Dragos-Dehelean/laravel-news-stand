<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Your Newsstand</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>

    <script src="https://use.fontawesome.com/a5b1f9187e.js"></script>


    <style>
        .img-thumbnail{
            margin-right: 20px;
        }        

    </style>
    <script>
        //ask before delete
        function ConfirmDelete(){
            var x = confirm("Are you sure you want to delete this news item? It's your own work, seriously!");
            if (x)
                return true;
            else
                return false;
        }
    </script>

</head>

<body>

    <div class="navbar navbar-inverse">        
        <div class="container"> 
            <div class="navbar-header">                
                <a class="navbar-brand" href="{{ url('/') }}">Your Newsstand</a>
            </div>
            <ul class="nav navbar-nav">               
                 
            @if (Auth::check()) 

                <li class="active">
                    <a href="{{ url('myindex') }}">Your News</a>
                </li>                   
                <li class="active">
                    <a href="{{ url('/articles/create') }}">Add News</a>
                </li>
                <li class="active">
                    <a href="{{ url('logout') }}">Logout</a>
                </li>                
            @else
                <li class="active">
                    <a href="{{ url('login') }}">Login </a>
                </li>

                <li class="active">
                    <a href="{{ url('/auth/register') }}">Register</a>
                </li>
            @endif 
                <li>
                    <a href="/feed" style="all:unset;" target="_blank" class="navbar-brand"><img src="/uploads/rss_icon.jpg" height="50"></a>
                </li>           
             
            </ul>
        </div>
    </div>  
    

    <div class="container">

        <div class="col-md-9 blog-main">
        
            @include('layouts.flash')
            @include('layouts.errors')   



            @yield('content')
        
        </div> 

    </div>    
    
</body>
</html>