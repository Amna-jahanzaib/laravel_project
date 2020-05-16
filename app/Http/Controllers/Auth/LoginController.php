<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
{
    foreach($user->roles as $key => $roles)
    {
        if($roles->id==1)
        {
            return redirect()->route('admin.dashboard');

        }

        if($roles->id==2)
        {
    
            if ($user->doctor->is_registered == 0) { // or whatever status column name and value indicates a blocked user

                $message = 'Sorry, You are not verified by the admin. Please check your email for more information.';
        
                // Log the user out.
                $this->logout($request);
        
                // Return them to the log in form.
                return redirect()->back()
                ->withInput($request->input())
                ->withErrors([
                        // This is where we are providing the error message.
                        'email' => $message,
                    ]);
            }
            else{
                return redirect()->route('doctor.dashboard');

            }
        

        }
        if($roles->id==3)
        {
            return redirect()->route('patient.dashboard');

        }

    
    }

}

}
