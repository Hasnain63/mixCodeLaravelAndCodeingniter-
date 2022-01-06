<?php

namespace App\Http\Controllers\Supervisor;

use App\Mail\SendMail;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Models\MidTermReport;
use Illuminate\Mail\Mailable;
use App\Mail\AcceptProposalMail;
use App\Mail\RejectProposalMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;



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
            $proposals = Proposal::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get();
            return view('supervisor.proposal.index', compact('proposals', 'mid_term_reports', 'project'));
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
    public function store(Request $request)
    {
        //
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
        $proposal = Proposal::findOrFail($id);
        $proposal_user = Proposal::with('user')->findOrFail($id);
        $proposal_email = $proposal_user->user->email;
        $proposal_name = $proposal_user->user->name;
        $proposal_project_name = $proposal->title;
        if (request()->is_accepted == 2) {
            //reject
            $proposal->update(['is_accepted' => 2]);
            Supervisor::where('user_id', $proposal->supervisor_id)->decrement('pending_proposals', 1);

            $email = $proposal_email;
            $name = $proposal_name;
            $proposal_title = $proposal_project_name;

            $data = array(
                'name'      =>  $name,
                'title' => $proposal_title
            );

            Mail::to($email)->send(new RejectProposalMail($data));

            return back()->with('success', 'Proposal Cancelled Successfully');
        } else {
            //accept
            $proposal->update(['is_accepted' => 1]);
            Supervisor::where('user_id', $proposal->supervisor_id)->decrement('slots', 1);
            Supervisor::where('user_id', $proposal->supervisor_id)->decrement('pending_proposals', 1);
            $email = $proposal_email;
            $name = $proposal_name;
            $proposal_title = $proposal_project_name;


            $data = array(
                'name'      =>  $name,
                'title' => $proposal_title

            );

            Mail::to($email)->send(new AcceptProposalMail($data));
            return back()->with('success', 'Proposal Accepted Successfully');
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