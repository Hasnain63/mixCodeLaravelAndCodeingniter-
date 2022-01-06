@extends('layouts.backend')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisors.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Supervisors Form</h6>
                <form class="forms-sample" method="POST" action="{{ route('viva.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title"> Viva Day</label>
                        <input type="datetime-local" class="form-control" id="title" autocomplete="off"
                            placeholder="Title" name="viva">
                    </div>
                    <input type="hidden" name="supervisor_id" id="supervisor_id" value="{{$supervisor_id}}">
                    <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('viva.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection