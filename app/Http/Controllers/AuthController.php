<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function show()
    {
        return view("auth", [
            "title" => "VERIFICÃO DE E-MAIL",
            "userEmail" => "teste@gmail.com",
        ]);
    }
}
