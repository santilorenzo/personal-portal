<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Calculate my age since my birthday: 1989-28-12
        $age = date_diff(date_create('1989-12-28'), date_create('today'))->y;
        // Calculate 2 coffee a day for the working days since 2012-05-01
        $coffee = date_diff(date_create('2012-05-01'), date_create('today'))->days * 2;

        $workingYears = date_diff(date_create('2012-05-01'), date_create('today'))->y;

        return view('home', ['age' => $age, 'coffee' => $coffee, 'workingYears' => $workingYears]);
    }
}
