@extends('layouts.backend')

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Permission</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Permission Update Form</h6>
                    <form class="forms-sample" method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" id="name" autocomplete="off" placeholder="Permission Name" name="name" value="{{ $permission->name }}">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
