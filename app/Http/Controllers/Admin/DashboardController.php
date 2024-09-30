<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(){
        
        $projectCount = Project::count('id');

        return view('admin.index', compact('projectCount'));
    }
}
