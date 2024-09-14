<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        return view("dashboard", [
            "title" => "DASHBOARD",
            "userName" => "teste",
            "pathToProfileImage" => "#",
            "userEmail" => "teste@gmail.com",
            "userPassword" => "teste",
        ]);
    }
}
