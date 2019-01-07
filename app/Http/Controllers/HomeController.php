<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khsing\World\World;
use Khsing\World\Models\Continent;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asia = Continent::getByCode('AS');
        $countries = $asia->countries()->get();
// or use children method
        $countries = $asia->children();
        dd($asia, $countries->toArray());
        return view('home');
    }
}
