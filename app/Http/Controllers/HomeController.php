<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('home');
    }


    public function test() {
        $starDate = date('Y-m-d', time() - 691200);
        $endDate  = date('Y-m-d');

        $data = Assignment::getUnpostData($starDate);

        return view('mails.weekly',['groups' => $data['groups'], 'startDate' => $starDate, 'endDate' => $endDate]);
    }
}
