@extends('layouts.backend')

@section('content')

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-icon-text">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Create User
            </a>
        </div>
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
                                   Group Name
                                </th>
                                <th>
                                   Group Email
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
                            @foreach ($groups as $key => $group)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $group->user->name }}</td>
                                <td>{{ $group->user->email }}</td>                               
                                
                                <td>
                                    {{ \Carbon\Carbon::parse($group->created_at)->diffForhumans() }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($group->updated_at)->diffForhumans() }}
                                </td>
                                <td>
                                    <form class="d-inline-block" action="{{ route('groups.destroy',$group) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon-text">
                                            <i class="btn-icon-prepend" data-feather="trash"></i> Delete
                                        </button>
                                    </form>                                                           
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
