<?php

namespace App\Http\Controllers\Group;

use App\Models\Viva;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\MidTermReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Group\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $id = MidTermReport::where(['user_id' => auth()->id(), 'is_accepted' => 1])->first()->supervisor_id;
        return view('group.project.index', compact('id', 'proposals', 'mid_term_reports', 'project', 'project_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status()
    {
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
        $is_accepted = Project::where('user_id', auth()->id())->first()->is_accepted;
        $project = Project::with('supervisor')->orderBy('id', 'DESC')->where('user_id', auth()->id())->get();
        return view('group.project.report', compact('project', 'is_accepted', 'proposals', 'mid_term_reports', 'project', 'project_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $proposal = Project::create($request->except(['document', 'project']) + ['user_id' => auth()->id(), 'is_accepted' => 0]);
        $proposal->addMediaFromRequest('document')->toMediaCollection('mid_term_report');
        $proposal->addMediaFromRequest('project')->toMediaCollection('project');

        return redirect()->route('project.index')->with('success', 'Project submitted successfully');
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
        //
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