@extends('layouts.backend')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>


</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Users</h6>
                <p class="card-description">All the users are listed here.</p>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Stuent 1 Name
                                </th>
                                <th>
                                    Stuent 2 Name
                                </th>
                                <th>
                                    Stuent 1 Email
                                </th>
                                <th>
                                    Stuent 2 Email
                                </th>
                                <th>
                                    Stuent 1 Roll No
                                </th>
                                <th>
                                    Stuent 2 Roll No
                                </th>
                                <th>
                                    Stuent 1 Session
                                </th>
                                <th>
                                    Stuent 2 Session
                                </th>
                                <th>
                                    Stuent Department
                                </th>
                                <th>
                                    Stuent 1 Card Image
                                </th>
                                <th>
                                    Stuent 2 Card Image
                                </th>
                                <th>
                                    Created At
                                </th>
                                <th>
                                    Updated At
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $key => $application)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $application->std_1_name }}</td>
                                <td>{{ $application->std_2_name }}</td>
                                <td>{{ $application->std_1_email }}</td>
                                <td>{{ $application->std_2_email }}</td>
                                <td>{{ $application->std_1_roll_no }}</td>
                                <td>{{ $application->std_2_roll_no }}</td>
                                <td>{{ $application->std_1_session }}</td>
                                <td>{{ $application->std_2_session }}</td>
                                <td>{{ $application->department_id }}</td>
                                <td>{{ $application->getFirstMedia('std_1_card') }}</td>
                                <td>{{ $application->getFirstMedia('std_2_card') }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($application->created_at)->diffForhumans() }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($application->updated_at)->diffForhumans() }}
                                </td>
                                <td>
                                    <form class="d-inline-block"
                                        action="{{ route('applications.destroy',$application) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon-text">
                                            <i class="btn-icon-prepend" data-feather="trash"></i> Delete
                                        </button>
                                    </form>
                                    @if($application->is_registered == 0)
                                    <form class="d-inline-block" action="{{ route('applications.store') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="student_email_1"
                                            value="{{ $application->std_1_email }}">
                                        <input type="hidden" name="student_email_2"
                                            value="{{ $application->std_2_email }}">
                                        <input type="hidden" name="registration_id" value="{{ $application->id }}">
                                        <button type="submit" class="btn btn-success btn-icon-text">
                                            <i class="btn-icon-prepend" data-feather="plus"></i> Register
                                        </button>
                                    </form>
                                    @endif
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