<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Task;
use DateTime;
use Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalEmployees = DB::table('employees')->count();
        $totalClients = DB::table('clients')->count();
        $totalProjects = DB::table('projects')->count();
        $processProjects = DB::table('projects')->where('status', 'process')->count();
        $pendingProjects = DB::table('projects')->where('status', 'pending')->count();
        $completedProjects = DB::table('projects')->where('status', 'completed')->count();
        $totalTasks = DB::table('tasks')->count();
        $totalTasksOngoing = DB::table('tasks')->where('status', 'ongoing')->count();
        $totalTasksCompleted = DB::table('tasks')->where('status', 'completed')->count();

        $projectStatus = DB::table('tasks')
        ->join('projects', 'projects.id', '=', 'tasks.project_id')
        ->select('projects.id','projects.title', DB::raw('COUNT(tasks.status) as count_status'))
        ->where('tasks.status', 'completed')
        ->groupBy('projects.id','projects.title')
        ->get();

        $todayLeaves = DB::table('leaves')->whereDate('created_at', date('Y-m-d'))->count();

        $totalUser = DB::table('users')->select('employee_id')->where('employee_id', Auth::user()->employee_id)->get();
        // dd($totalUser);
        // $totalUser = DB::table('users')->count();
        $totalUserActive = DB::table('users')->where('status', 1)->count();
        $totalUserInactive = DB::table('users')->where('status', 0)->count();


        // $totalLoggedInUser = Auth::user()->;
        // dd($totalLoggedInUser);

        $ongoingTasks = Task::where(['status' => 'ongoing'])->get();



        return view('dashboard/index', compact(
            'totalEmployees',
            'totalClients',
            'totalProjects',
            'processProjects',
            'pendingProjects',
            'completedProjects',
            // 'projectStatus',
            'totalTasks',
            'totalTasksOngoing',
            'totalTasksCompleted',
            'ongoingTasks',
            // 'todayLeaves',
            // 'totalUser',
            // 'totalUserActive',
            // 'totalUserInactive'
        ));
    }
}
