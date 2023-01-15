<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenances;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_under_review = Maintenances::join('assets', 'assets.serial_number', '=', 'maintenances.serial_number')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->where('users.id', '=', Auth::user()->id)->where('status', 'under_review')->count();
        $count_rejected = Maintenances::join('assets', 'assets.serial_number', '=', 'maintenances.serial_number')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->where('users.id', '=', Auth::user()->id)->where('status', 'rejected')->count();
        $count_approved = Maintenances::join('assets', 'assets.serial_number', '=', 'maintenances.serial_number')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->where('users.id', '=', Auth::user()->id)->where('status', 'approved')->count();

        return view('home')->with('count_approved', $count_approved)->with('count_rejected', $count_rejected)->with('count_under_review', $count_under_review);
    }
}
