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
                <h6 class="card-title">Viva</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>
                                    Group
                                </th>
                                <th>
                                    Supervisor
                                </th>
                                <th>
                                    Viva Day
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viva as $rowdata)
                            <tr>
                                <td>{{ $rowdata->user->name }}</td>
                                <td>{{ $rowdata->supervisor->name }}</td>
                                <td>
                                    {{ $rowdata->viva }}
                                </td>
                            </tr>@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection