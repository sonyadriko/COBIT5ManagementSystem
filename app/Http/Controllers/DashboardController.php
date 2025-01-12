<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\ProcessAudit;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
{
    $totalQuestions = Question::count();
    $totalProcessAudits = ProcessAudit::count();
    $totalProjects = Project::count();

    return view('dashboard', compact('totalQuestions', 'totalProcessAudits', 'totalProjects'));
}
}
