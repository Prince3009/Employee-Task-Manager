<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        // Fetch tasks assigned to the logged-in employee
        $tasks = auth()->user()->tasks;

        // Pass the tasks to the employee dashboard view
        return view('employee.dashboard', compact('tasks'));
    }
}
