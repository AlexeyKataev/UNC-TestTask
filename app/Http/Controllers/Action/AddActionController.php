<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddActionController extends Controller
{
    public function addActionView()
    {
        return view('action.add_action');
    }
}
