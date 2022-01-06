@extends('layouts.backend')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supervisors</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Supervisors</h6>
                <p class="card-description">All the supervisors are listed here.</p>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Documentation
                                </th>
                                <th>
                                    Project
                                </th>
                                <th>
                                    Group
                                </th>

                                <th>
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project_data as $key => $row)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $row->title }}</td>
                                <td><a class="btn btn-primary"
                                        href="{{ $row->getFirstMediaUrl('mid_term_report') }}">Download</a></td>
                                <td><a class="btn btn-primary"
                                        href="{{ $row->getFirstMediaUrl('project') }}">Download</a></td>
                                <td>{{ $row->user->name }}</td>
                                <td>
                                    <a href="{{ route('projects.edit',[$row->id,'is_accepted' => 1]) }}"
                                        class="btn btn-success btn-icon-text">
                                        <i class="btn-icon-prepend" data-feather="edit"></i> Accept
                                    </a>
                                    <a href="{{ route('projects.edit',[$row->id,'is_accepted' => 2]) }}"
                                        class="btn btn-danger btn-icon-text">
                                        <i class="btn-icon-prepend" data-feather="edit"></i> Reject
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection