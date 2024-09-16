<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function index()
    {
        return view("temperature", [
            "title" => "DASHBOARD",
            "userName" => "teste",
            "pathToProfileImage" => "#",
        ]);
    }
}
