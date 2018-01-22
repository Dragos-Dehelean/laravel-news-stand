<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\User;
use App\Mailers\AppMailer; //special class for the project, using PHPMailer

class RegistrationController extends Controller
{    

	public function register(){

		return view('auth.register');

	}

	public function postRegister(Request $request, AppMailer $mailer)
	{

		//validates the $request input, with rules. If it fails, the method sends back with input and errors
		$this->validate($request, [
			'name' => 'required|unique:users',
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);

		//creates the user with the $request input and saves it to database
		$email_token = str_random(30);
		$user = User::create([
			'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
            'email_token' => $email_token
        ]);

		//send the email confirmation message
		$mailer->sendEmailConfirmationTo($user);
		
		//flash a message to the session
		session()->flash('message', 'Thanks for signing up! Please confirm your email address.');

		//redirect back		
		return redirect()->back();
	}

	/**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
	public function confirmEmail($email_token)
    {
       
        $user = User::where('email_token', $email_token)->first();

        if ( ! $user ) { 
        	
        	session()->flash('message', "The user doesn't exist or has been already confirmed. Please login"); 
        	
        
        } else { // saves the user as verified

	        $user->verified = 1;
	        $user->email_token = null;
	        $user->save();

	        //flash a message to the session
			session()->flash('message', 'You have successfully verified your account. Please login');
    	}

    	return redirect('login');

    }

	

}
