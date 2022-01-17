<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;
use App\Contracts\Services\Auth\AuthServiceInterface;
use Session;

class AuthController extends Controller
{
    /**
     * Auth Interface
     */
    private $authInterface;

    /**
     * Create a new controller instance.
     * @param AuthServiceInterface $authServiceInterface
     * @return void
     */
    public function __construct(AuthServiceInterface $authServiceInterface)
    {
        $this->authInterface = $authServiceInterface;
    }

    /**
     * To show login page
     *
     * @return View login form
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * To Login the user
     * 
     * @param \Illuminate\Http\Request $request
     * @return redirect()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Check user want to remember me or not.
        $remember = isset($request->remember) ? true : false;
        $credentials = $request->only('email', 'password');
        // Check logged in successfully or not.
        if ($this->authInterface->login($credentials, $remember)) {
            //return redirect()->intended('dashboard')
            return view('dashboard')->with('success','You have Successfully logged in');
            //   ->withSuccess('You have Successfully loggedin');
           
        }

        return redirect("login")->withErrors('Oppes! You have entered invalid credentials');
    }

    /**
     * To show register page
     *
     * @return View login form
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * To register the user
     *
     * @param App\Http\Requests\UserRegisterRequest $request
     * @return redirect()
     */
    public function postRegistration(UserRegisterRequest $request)
    {
        $this->authInterface->saveUser($request);

        return redirect()
            ->route('dashboard')
            ->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * To logout the user
     *
     * @return redirect()
     */
    public function logout()
    {
        // Destory all session and log out the user.
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
