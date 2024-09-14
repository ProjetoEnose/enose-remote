<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SensorsController extends Controller
{
    public function show()
    {
        return view("sensors", [
            "title" => "SENSORS",
            "userName" => "test",
            "pathToProfileImage" => "#"
        ]);
    }
}
