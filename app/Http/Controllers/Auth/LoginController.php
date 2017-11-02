<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/store';


    public function __construct()
    {

        $this->middleware('guest', ['except' => 'logout']);
        Session::put('backUrl', URL::previous());
    }

    public function redirectTo()
    {
        return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
    }

    //url()->previous()
    //redirect()->intended();
    //request()->headers->get('referer')
    //$url = request()->headers->get('referer');
    //$path = parse_url($url)['path'];
    //$this->redirectTo = $path;

    //$this->middleware('guest')->except('logout');

}
