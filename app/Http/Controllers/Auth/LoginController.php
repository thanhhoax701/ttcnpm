<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function getLogin()
    {
        $title = 'login';
        return view('auth.login', compact('title'));
    }

    public function postLogin(Request $request)
    {
        $credentials = $this->getCredentials($request);

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        $email = "";
        // dd($user->password);
        if ($user) {
            $email = $user->email;
        }
        // Authenticate the user
        if (Auth::attempt(['email' => $email, 'password' => $request->Password], $request->get('remember'))) {
            return redirect()->route('home');
        } else {
            return redirect()->to('login')
                ->withErrors(trans('app.login-false'));
        }
    }


    public function getCredentials(Request $request)
    {
        return [
            'email' => $request->Email,
            'password' => $request->Password
        ];
    }
    public function forgotpassword(Request $request)
    {
        $title = 'Forgot password';
        if($request->isMethod('post')){
            // dd($request);
            $user = User::where('email', $request->Email)
            ->first();
            if (Hash::check($request->input('old-password'), $user->password)) {
                 User::whereId($user->id)->update([
                    'password' => Hash::make($request->input('new-password')) // Hashing passwords
                ]);
                
                return redirect()->route('forgot-password')->withSuccess('Lấy lại mật khẩu thành công.');
                //$2y$10$YzX7O1nQayboyc/jl7wSD.9MK7uZ2XrKJzDAB4Nx4l0ulaUDlRgQ6
            }else{
                return redirect()->route('forgot-password')->withErrors('Mật khẩu cũ không đúng.');
            }
            // dd($user);
        }
        return view('auth.forgotpassword', compact('title'));
    }
}
