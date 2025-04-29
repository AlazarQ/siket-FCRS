<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
class AuditController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        $audits = Audit::when($userId, function ($query, $userId) {
            return $query->where('user_id', $userId);
        })->paginate(10);

        return view('audit.index', compact('audits', 'userId'));
    }
}
