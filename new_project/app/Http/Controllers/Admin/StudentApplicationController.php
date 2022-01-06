<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\StudentRegisterMail;
use Illuminate\Support\Facades\Mail;

class StudentApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Registration::where('is_registered', 0)->get();
        return view('backend.registrations.index', compact('applications'));
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
        $student_1_email = $request->student_email_1;
        $student_2_email = $request->student_email_2;
        // dd($student_1_email, $student_2_email);
        $current_year = now()->format('Y');
        $count = User::whereYear('created_at', $current_year)->whereHas('roles', function ($q) {
            $q->where('name', 'group');
        })->get();
        $group_name = 'GC-' . now()->format('Y') . '-G' . $count->count();
        $group_email = 'gc-' . now()->format('Y') . '-G' . $count->count() . '@gmail.com';
        $password = bcrypt('12345678');
        $user = User::create(['name' => $group_name, 'password' => $password, 'email' => $group_email]);
        $user->assignRole(3);

        Group::create(['user_id' => $user->id, 'registration_id' => $request->registration_id]);

        $registration = Registration::find($request->registration_id);
        $registration->update(['is_registered' => 1]);

        $data = array(
            'name'      =>  $group_name,
            'groupEmail' => $group_email,
            'password' => 12345678

        );
        Mail::to($student_1_email)->send(new StudentRegisterMail($data));
        if (!empty($student_2_email)) {
            Mail::to($student_2_email)->send(new StudentRegisterMail($data));
        }
        // Mail::to($student_2_email)->send(new StudentRegisterMail($data));
        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        try {
            Registration::findOrFail($id)->delete();
            return redirect()->route('applications.index')->with('success', 'Application deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}