<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        
        $projectCount = Project::where('user_id', Auth::id())->count('id');

        return view('admin.index', compact('projectCount'));
    }
}
