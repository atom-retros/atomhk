<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function __invoke()
    {
        if (!hasPermission(Auth::user(), 'view_activity_logs')) {
            abort(401);
        }

        return view('logs.index', [
            'logs' => Activity::query()->latest()->paginate(15),
        ]);
    }
}