<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SensorsController extends Controller
{
    public function index()
    {
        return view("sensors", [
            "title" => "SENSORS",
            "pathToProfileImage" => "#"
        ]);
    }
}
