<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionsController extends Controller
{
    public function actionsView()
    {
        return view('action.actions');
    }
}
