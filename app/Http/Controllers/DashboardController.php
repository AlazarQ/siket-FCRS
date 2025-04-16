<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FCY_Request;

class DashboardController extends Controller
{
    public function showMetrics() {
        $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple'];
        $data = [];

        $requests = FCY_Request::select('status',('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        foreach ($requests as $request) {
            $labels[] = $request->status;
            $data[] = $request->count;
        }

        return view('dashboard', compact('labels', 'data'));
    }
}
