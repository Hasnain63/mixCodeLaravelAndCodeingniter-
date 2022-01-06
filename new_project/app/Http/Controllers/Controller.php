<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $proposals = Proposal::with('user')->where(['supervisor_id' => auth()->id(), 'is_accepted' => 0])->get();
        return view('backend.index', compact('proposals'));
    }
}