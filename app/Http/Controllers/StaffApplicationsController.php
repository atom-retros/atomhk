<?php

namespace App\Http\Controllers;

use App\Models\WebsiteStaffApplication;
use App\Services\RconService;
use Illuminate\Support\Facades\Auth;

class StaffApplicationsController extends Controller
{
    public function index()
    {
        if (!hasPermission('manage_staff_applications')) {
            return to_route('dashboard')->withErrors(__('You do not have permission to view this page.'));
        }

        return view('staff-applications.index', [
            'applications' => WebsiteStaffApplication::query()
                ->with(['user', 'rank', 'status'])
                ->latest()
                ->paginate(15),
        ]);
    }

    public function show(WebsiteStaffApplication $application)
    {
        if (!hasPermission('manage_staff_applications')) {
            return to_route('dashboard')->withErrors(__('You do not have permission to view this page.'));
        }

        return view('staff-applications.show', [
            'application' => $application->load('user', 'rank', 'status'),
        ]);
    }

    public function accept(WebsiteStaffApplication $application, RconService $rconService)
    {
        if (!hasPermission('manage_staff_applications')) {
            return to_route('dashboard')->withErrors(__('You do not have permission to view this page.'));
        }

        if ($application->status()->exists() && $application->status->accepted) {
            return back()->withErrors(__('This application has already been handled!'));
        }

        $application->update([
            'old_rank_id' => $application->user->rank,
        ]);

        if ($rconService->isConnected() && $application->user->online) {
            $rconService->disconnectUser($application->user);
            sleep(0.5);

            $rconService->setRank($application->user, $application->rank_id);
        } else {
            $application->user->update([
                'rank' => $application->rank_id,
            ]);
        }

        $application->status()->updateOrCreate(['application_id' => $application->id], [
            'user_id' => $application->user->id,
            'staff_id' => Auth::id(),
            'accepted' => true,
        ]);

        return back()->with('success', __('The application has been accepted!'));
    }

    public function reject(WebsiteStaffApplication $application)
    {
        if (!hasPermission('manage_staff_applications')) {
            return to_route('dashboard')->withErrors(__('You do not have permission to view this page.'));
        }

        if ($application->status()->exists() && !$application->status->accepted) {
            return back()->withErrors(__('This application has already been handled!'));
        }

        $application->status()->updateOrCreate(['application_id' => $application->id], [
            'user_id' => $application->user->id,
            'staff_id' => Auth::id(),
            'accepted' => false,
        ]);

        return back()->with('success', __('The application has been rejected!'));
    }

    public function reset(WebsiteStaffApplication $application, RconService $rconService)
    {
        if (!hasPermission('manage_staff_applications')) {
            return to_route('dashboard')->withErrors(__('You do not have permission to view this page.'));
        }

        if (!$application->status()->exists()) {
            return back()->withErrors(__('This application has yet to be handled!'));
        }

        if (!$application->old_rank_id) {
            $application->status()->delete();

            return back()->with('success', __('The application has been reset!'));
        }

        if ($rconService->isConnected() && $application->user->online) {
            $rconService->disconnectUser($application->user);
            sleep(0.5);

            $rconService->setRank($application->user, $application->old_rank_id);
        } else {
            $application->user->update([
                'rank' => $application->old_rank_id,
            ]);
        }

        $application->update([
            'old_rank_id' => null,
        ]);

        $application->status()->delete();

        return back()->with('success', __('The application has been reset!'));
    }
}