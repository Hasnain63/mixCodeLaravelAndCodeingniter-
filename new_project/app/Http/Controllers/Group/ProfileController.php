<?php

namespace App\Http\Controllers\Group;

use App\Models\Viva;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\MidTermReport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Group\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('supervisor')) {
            $proposals = Proposal::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get()->map(function ($item) {
                $item['name'] = 'proposal';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $mid_term_reports = MidTermReport::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get()->map(function ($item) {
                $item['name'] = 'Mid Term Report';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project = Project::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get()->map(function ($item) {
                $item['name'] = 'project';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project = collect(array_merge($proposals, $mid_term_reports, $project))->sortByDesc('created_at')->groupBy('created_at')->values()->all();
            return view('backend.profile.index', compact('proposals', 'mid_term_reports', 'project'));
        } elseif (Auth::user()->hasRole('group')) {
            $proposals = Proposal::with('user')->where(['user_id' => auth()->id()])->whereIn('is_accepted', [1, 2])->get()->map(function ($item) {
                $item['name'] = 'proposal';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $mid_term_reports = MidTermReport::with('user')->where(['user_id' => auth()->id()])->whereIn('is_accepted', [1, 2])->get()->map(function ($item) {
                $item['name'] = 'Mid Term Report';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project = Project::with('user')->where(['user_id' => auth()->id()])->whereIn('is_accepted', [1, 2])->get()->map(function ($item) {
                $item['name'] = 'project';
                $item['created'] = $item['created_at']->diffForHumans();
                return $item;
            })->toArray();
            $project_data = collect(array_merge($proposals, $mid_term_reports, $project))->sortByDesc('created_at')->groupBy('created_at')->values()->all();
            return view('backend.profile.index', compact('proposals', 'mid_term_reports', 'project', 'project_data'));
        } else {
            return view('backend.profile.index');
        }
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('password'), auth()->user()->password))) {
            // The passwords matches
            return back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        //Change Password
        $user = auth()->user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->route('dashboard')->with('success', 'Password changed successfully');
    }
}