<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;

class AuthController extends Controller
{
    //
    use PasswordValidationRules;

    public function showLogin()
    {
        return view('auth.login');
    }

    public function handleRegister(Request $input)
    {
        try {
            $valData = $input->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => $this->passwordRules(),
            ]);

            $password = $input->password;

            $user = new User();
            $user->name = $valData['name'];
            $user->email = $valData['email'];
            $user->password = Hash::make($valData['password']);

            $user->save();


            return redirect()->route('admin.auth.register')
                        ->with('success', 'User: ' . $input->name . ' created successfully. Password: ' . $password);
        } catch (\Exception $e) {
            return redirect()->route('admin.auth.register')
                        ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function doLogin(Request $request)
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make($request::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
            ->withErrors($validator) // send back all errors to the login form
            ->withInput($request::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            // create our user data for the authentication
            $userdata = array(
            'email'     => $request::get('email'),
            'password'  => $request::get('password')
        );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

            // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                echo 'SUCCESS!';
            } else {

            // validation not successful, send back to form
                return Redirect::to('login');
            }
        }
    }
}
