<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailingsController extends Controller
{
    public function mailingsView()
    {
        $mailings = [];

        return view('mailing.mailings', ['mailings' => $mailings]);
    }
}
