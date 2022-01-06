<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\MidTermReport;
use App\Mail\AcceptMidtermMail;
use App\Mail\RejectMidtermMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MidTermReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $mid_term_reports = MidTermReport::where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get();
        return view('supervisor.mid-term-report.index', compact('mid_term_reports', 'proposals', 'project'));
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
        $mid_term_reports = MidTermReport::findOrFail($id);
        $mid_term_reports_user = MidTermReport::with('user')->findOrFail($id);
        $user_email = $mid_term_reports_user->user->email;
        $user_name = $mid_term_reports_user->user->name;
        $mid_term_reports_title = $mid_term_reports_user->title;
        if (request()->is_accepted == 2) {
            //reject
            $mid_term_reports->update(['is_accepted' => 2]);

            $email = $user_email;
            $name = $user_name;
            $mid_term_report_title = $mid_term_reports_title;
            $data = array(
                'name'      =>  $name,
                'title' => $mid_term_report_title
            );
            Mail::to($email)->send(new RejectMidtermMail($data));
            return back()->with('success', 'Mid Term Report Rejected Successfully');
        } else {
            //accept

            $mid_term_reports->update(['is_accepted' => 1]);
            $email = $user_email;
            $name = $user_name;
            $mid_term_report_title = $mid_term_reports_title;
            $data = array(
                'name'      =>  $name,
                'title' => $mid_term_report_title
            );
            Mail::to($email)->send(new AcceptMidtermMail($data));
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