@extends('layouts.backend')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Profile Form</h6>
                <form class="forms-sample" method="POST" action="{{ route('change.password') }}">
                    @csrf
                    <div class="form-group">
                        <label class="current password">Current Password </label>
                        <input type="password" class="form-control" autocomplete="off" name="password"
                            placeholder="Current Password">
                    </div>

                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" class="form-control" id="new-password" autocomplete="off"
                            placeholder="New Password" name="new-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password-confirmed">Confirm Password</label>
                        <input type="password" class="form-control" id="new-password-confirmed" autocomplete="off"
                            placeholder="Confirm Password" name="new-password-confirmed">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection