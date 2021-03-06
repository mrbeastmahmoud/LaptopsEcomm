<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;
    /*
        * @return view
        * */

    public function getLoginForm()
    {
        return view('Authenticate.LoginSignUp');
    }
    /*
        * @Parm  Request $request
        * @return Token
        * */

    public function postLogin(Request $request)
    {

        $attr = $request->validate([
            'email' => 'required',
            'password' => 'required',

        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }
    /*
        * @Parm  Request $request
        * @return Redirect
        * */
    public function register(Request $request)
    {


        $attr = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|string',
            'password' => 'required|string|min:4',
            'password_confirm' => 'required|same:password',
            'gender' => 'required',

        ]);

        $user = User::create([
            'password' => bcrypt($attr['password']),
            'email' => $attr['email'],
            'gender' => $attr['gender'],
            'name' => $attr['name'],

        ]);
        session()->regenerate();
        Auth::login($user);
        return redirect('/');
    }
    /*
        * @return View
        * */
    public function getSignup()
    {
        return view('Authenticate.Signup');
    }
    /*
        * @Parm  Request $request
        * @return Redirect
        * */
    public function logout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');

    }
}
