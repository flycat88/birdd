<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate the count of occupied and vacant units
        $occupiedCount = Unit::where('occupancy_status', 1)->count();  // 1 for occupied
        $vacantCount = Unit::where('occupancy_status', 0)->count();    // 0 for vacant

        // Pass the data to the correct view
        return view('users.dashboard', compact('occupiedCount', 'vacantCount'));
    }
}