<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintenances;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index(){
        $count_under_review = Maintenances::where('status', 'under_review')->count();
        $count_rejected = Maintenances::where('status', 'rejected')->count();
        $count_approved = Maintenances::where('status', 'approved')->count();
        return view('Admin.index')->with('count_approved', $count_approved)->with('count_rejected', $count_rejected)->with('count_under_review', $count_under_review);
    }
}
