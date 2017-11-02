<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{


    use ResetsPasswords;


    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest');
        Session::put('backUrl', URL::previous());
    }

    public function redirectTo()
    {
        return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
    }
}
