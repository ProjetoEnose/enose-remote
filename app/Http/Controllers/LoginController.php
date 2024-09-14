<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return view("login", [
            "title" => "LOGIN",
            "showModal" => true
        ]);
    }

    public function  check(Request $request)
    {
        dd($request);
    }

    public function logout()
    {
        return "logout";
    }
}
