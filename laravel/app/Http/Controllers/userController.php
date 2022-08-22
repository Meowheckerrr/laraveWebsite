<?php

namespace App\Http\Controllers;

use App\Models\User;
use Egulias\EmailValidator\Result\InvalidEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    public function create(){
        return view("users.register");
    }


    //New Register
    public function store(Request $request){

        //dd($request->all());
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>'required|confirmed|min:6'
        ]);

        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);

        //login
        auth()->login($user);
        return redirect("/listings")->with("message","User created and logged in");

    }
    //Logout User
    public function logout(Request $request){

        auth()->logout(); //remove the authentication information from the user session  

        //Recommended
        $request->session()->invalidate();      //Invalidate the user session    
        $request->session()->regenerateToken(); //Regenerate their Token   (Avoid CSRF 

        return redirect('/listings')->with("message","You have been Logged out.  Meowmeow");

    }

    //Show login form
    public function login(){

        return view("users.login");

    }

    //Authenticate User
    public function authenticate(Request $request){

        $formFields = $request->validate([
            'email'=>['required','email'],
            'password'=>'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/listings')->with('message','You are now logged in !!!');

        }

        return back()->withErrors(['email' => 'InvalidCredentials'])->onlyInput('email');

        

    }

}
