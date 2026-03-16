<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;

class ProcessController extends Controller
{
    public function index()
    {
        $steps = ProcessStep::active()->ordered()->get();
        
        return view('web.process', compact('steps'));
    }
}
