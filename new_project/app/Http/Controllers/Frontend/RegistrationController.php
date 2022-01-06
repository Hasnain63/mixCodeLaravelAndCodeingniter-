<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\RegisterRequest;
use App\Http\Requests\Registration\RegistrationRequest;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.registration');
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
    public function store(RegistrationRequest $request)
    {
        $registration =   Registration::create($request->except(['std_1_card', 'std_2_card']));
        $registration->addMediaFromRequest('std_1_card')->toMediaCollection('std_1_card');
        $registration->addMediaFromRequest('std_2_card')->toMediaCollection('std_2_card');
        return redirect('/')->with('success', 'Appplication has been submited');
    }

    public function singleUserRegister()
    {
        return view('frontend.singleUserRegistration');
    }
    public function save(RegisterRequest $request)
    {
        $registration =   Registration::create($request->except(['std_1_card']));
        $registration->addMediaFromRequest('std_1_card')->toMediaCollection('std_1_card');
        return redirect('/')->with('success', 'Appplication has been submited');
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