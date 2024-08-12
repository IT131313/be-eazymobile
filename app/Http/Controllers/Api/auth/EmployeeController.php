<?php

namespace App\Http\Controllers\Api\Auth;


use App\Models\Employee;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }
}
