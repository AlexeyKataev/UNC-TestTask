<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionsController extends Controller
{
    public function actionsView()
    {
        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $actions = Action::with('user_creator')
            ->where('date_end', '>=', $nowTmsFormat)
            ->orderByDesc('id')
            ->get();

        return view('action.actions', [
            'actions' => $actions,
            'activePublicActionsCount' => DB::table('actions')
                ->where('date_end', '>=', $nowTmsFormat)
                ->where('is_private', FALSE)
                ->count(),
            'activePrivateActionsCount' => DB::table('actions')
                ->where('date_end', '>=', $nowTmsFormat)
                ->where('is_private', TRUE)
                ->count(),
            'stoppedActionsCount' => DB::table('actions')
                ->where('date_end', '<=', $nowTmsFormat)
                ->count(),
            'stoppedPublicActionsCount' => DB::table('actions')
                ->where('date_end', '<=', $nowTmsFormat)
                ->where('is_private', FALSE)
                ->count(),
            'stoppedPrivateActionsCount' => DB::table('actions')
                ->where('date_end', '<=', $nowTmsFormat)
                ->where('is_private', TRUE)
                ->count(),
            'actionsCount' => '',
        ]);
    }
}
