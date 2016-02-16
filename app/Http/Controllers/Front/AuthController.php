<?php

namespace App\Http\Controllers\Front;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        pagetitle( [ trans( 'main.login' ), settings( 'server_name' ) ] );
        return view('front.auth.login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'username';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $new_id = ( User::all()->count() > 0 ) ? User::orderBy( 'id', 'desc' )->first()->id + 1 : 2400;

        DB::connection('member')->table('tb_user')->insert([
           'mid' => $data['name'],
            'password' => $data['password'],
            'pwd' => Hash::make($data['password']),
            'idnum' => $new_id
        ]);

        DB::connection('account')->table('accounts')->insert([
            'id' => $new_id,
            'username' => $data['name'],
            'password' => $data['password'],
        ]);

        return User::create([
            'id' => $new_id,
            'username' => $data['name'],
            'password' => Hash::make($data['password']),
            'role' => 'member'
        ]);
    }
}
