<?php

namespace App\Http\Controllers\Group;

use App\Models\Viva;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Models\MidTermReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Proposal\ProposalRequest;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $supervisors = Supervisor::with('user')->get();
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
            $proposals = Proposal::with('user')->where('user_id', auth()->id())->get();
            return view('group.supervisors.index', compact('supervisors', 'proposals', 'mid_term_reports', 'project', 'project_data'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
    public function store(ProposalRequest $request)
    {
        $proposal = Proposal::create($request->except(['document']) + ['user_id' => auth()->id(), 'is_accepted' => 0]);
        Supervisor::where('user_id', $proposal->supervisor_id)->increment('pending_proposals', 1);
        $proposal->addMediaFromRequest('document')->toMediaCollection('proposal');
        return redirect()->route('supervisors.index')->with('success', 'Proposal send successfully');
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
        $id = Supervisor::findOrFail($id)->user_id;
        return view('group.proposal.index', compact('id', 'proposals', 'mid_term_reports', 'project', 'project_data'));
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