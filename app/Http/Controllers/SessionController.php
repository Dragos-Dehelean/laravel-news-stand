<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
    /**
     * Create a new sessions controller instance.
     
     /**
     * Show the login page.
     *
     * @return \Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Perform the login.
     *
     * @param  Request  $request
     * @return \Redirect
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,  
            'verified' => true          
        );

        if ( ! Auth::attempt($credentials)){

            return back()->withInput()->withErrors([
                    'credentials' => 'We were unable to sign you in.'
                ]);
        } else {

            session()->flash('message', 'Welcome back, ' . Auth::user()->name . '!');

            return redirect()->route('home');
        }
    }

    /**
     * Destroy the user's current session.
     *
     * @return \Redirect
     */
    public function logout()
    {
        
        Auth::logout();

        session()->flash('message', 'You have now been signed out. Goodbye.');

        return redirect()->route('home');
    }

    
}
