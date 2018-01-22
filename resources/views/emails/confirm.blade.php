<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Starter Template for Bootstrap</title>
    
</head>
<body>
   
   <h2>Please Verify Your Email Address</h2>

    <div>
        Thanks for creating an account with Your Newsstand.
        Please click the link to verify your 
        <a href='{{ url("register/confirm/{$user->email_token}") }}'> email address </a>    

    </div>

 
</body>
</html>