<?php

namespace App\Http\Controllers\Auth;

//use App\Http\Requests\Request;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

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
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /*
     * This is the code to login with ETSU authentication (LDAP)
     *
     * Currently, this should be commented out as we do not host on
     * ETSU's server, so it requires being on campus to actually login.
     *
     * Also, ensure you have your user account stored in the local/AWS database
     * with your exact ETSU credentials, or you will not be able to login.
     */

    public function login(Request $request)
    {
        //Validate credentials
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $ldap = ldap_connect('ldap://etsu.edu');
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap)
        {
            $status = @ldap_bind($ldap, $request->get('email') . "@ETSU", $request->get('password'));

            if($status)
            {
                ldap_unbind($ldap);
                $user = User::where('email', $request->get('email') . '@etsu.edu')->first();

                if($user)
                {
                    Auth::login($user);
                }
                else
                {
                    return redirect()->back()->withErrors(
                        'Username and/or Password are not matching!'
                    );
                }

                return redirect()->intended('/');
            }
            else
            {
                return redirect()->back()->withErrors(
                        'Username and/or Password are not matching!'
                    );
            }
        }
        else
        {
            return redirect()->back->withErrors(
                        'Unable to connect to ETSU LDAP server.  Please contact an Administrator.'
                    );
        }

        return redirect()->back()->withErrors(
            'Username and/or Password are not matching!'
        );
    }
}
