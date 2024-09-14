<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function show()
    {
        return view("temperature", [
            "title" => "DASHBOARD",
            "userName" => "teste",
            "pathToProfileImage" => "#",
            "userEmail" => "teste@gmail.com",
            "userPassword" => "teste",
        ]);
    }
}
