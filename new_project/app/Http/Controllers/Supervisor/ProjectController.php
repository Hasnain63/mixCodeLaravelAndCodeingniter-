<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\MidTermReport;
use App\Mail\AcceptProjectMail;
use App\Mail\RejectProjectMail;
use App\Http\Controllers\Controller;
use App\Models\Viva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_data = Project::where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get();
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

        return view('supervisor.project.index', compact('project', 'mid_term_reports', 'proposals', 'project_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $project_user = Project::with('user')->findOrFail($id);
        $user_email = $project_user->user->email;
        $user_name = $project_user->user->name;
        $project_title = $project_user->title;
        if (request()->is_accepted == 2) {
            //reject
            $project->update(['is_accepted' => 2]);
            $email = $user_email;
            $name = $user_name;
            $project_title_name = $project_title;
            $data = array(
                'name'      =>  $name,
                'title' => $project_title_name
            );
            Mail::to($email)->send(new RejectProjectMail($data));
            return back()->with('success', 'Project Rejected Successfully');
        } else {
            //accept

            $project->update(['is_accepted' => 1]);
            $email = $user_email;
            $name = $user_name;
            $project_title_name = $project_title;
            $data = array(
                'name'      =>  $name,
                'title' => $project_title_name
            );
            Mail::to($email)->send(new AcceptProjectMail($data));
            return back()->with('success', 'Project Accepted Successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}