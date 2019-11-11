<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['options'] = [
            'title' => 'Population of Largest U.S. Cities',
            'chartArea' => ['width' => '50%'],
            'hAxis' => [
                'title' => 'Total Population',
                'minValue' => 0
            ],
            'vAxis' => [
                'title' => 'City'
            ],
            'bars' => 'horizontal', //required if using material chart
            'axes' => [
                'y' => [0 => ['side' => 'right']]
            ]
        ];

        $data['cols'] = ['City', '2010 Population', '2000 PopulaÎtions'];
        $data['rows'] = [
            ['New York City, NY', 8175000, 8008000],
            ['Los Angeles, CA', 3792000, 3694000],
            ['Chicago, IL', 2695000, 2896000],
            ['Houston, TX', 2099000, 1953000],
            ['Philadelphia, PA', 1526000, 1517000]
        ];

        return view('home', $data);
    }
}
