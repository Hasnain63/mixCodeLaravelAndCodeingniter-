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
                                                            
                                <th>
                                    Group
                                </th>

                                <th>
                              Viva Day
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $student->user->name }}</td>                                                                
                                <td>
                                    <a href="{{ route('viva.edit',$student->id) }}"
                                        class="btn btn-info btn-icon-text">
                                        <i class="btn-icon-prepend" data-feather="edit"></i> Schedule Viva
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
