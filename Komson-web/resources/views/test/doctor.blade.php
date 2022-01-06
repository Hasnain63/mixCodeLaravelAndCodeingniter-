@extends('admin/layout');
@section('page_title','Doctor')
@section('doctor_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Doctor</h1>
            <a class="pull-right" href="{{url('admin/doctor/manage_doctor')}}"> <button type="button"
                    class="btn btn-success">Add
                    Doctor</button></a>
        </div>
        <div class="col-md-12 mt-4 mb-4">
            <!-- DATA TABLE-->
            @if(Session::has('message'))
            <div class="col-md-12">
                <div class="alert alert-success">{{Session::get('message')}}</div>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="col-md-12">
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            </div>
            @endif
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Birck Name</th>
                            <th>PMDC Id</th>
                            <th width=100> Name</th>
                            <th> DOB</th>
                            <th> Mobile</th>
                            <th width=100> M.address</th>
                            <th width=100> E.address</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{ $list->id}}</td>
                            <td>{{ $list->brick_name}}</td>
                            <td>{{ $list->pmdc_no}}</td>
                            <td>{{ $list->name}}</td>
                            <td>{{ $list->dateof_birth}}</td>
                            <td>{{ $list->mobile}}</td>
                            <td>{{ $list->morning_address	}}</td>
                            <td>{{ $list->evening_address}}</td>
                            <td>
                                <a href="{{url('admin/doctor/manage_doctor/')}}/{{$list->id}}">
                                    <i class="far fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="{{url('admin/doctor/delete/')}}/{{$list->id}}"><i class="fas fa-trash"></i></a>
                                &nbsp;
                                @if($list->status==1)
                                <a href="{{url('admin/doctor/status/0')}}/{{$list->id}}"
                                    class="btn btn-primary btn btn-sm"><i class="fas fa-toggle-on"></i></a>
                                @elseif($list->status==0)
                                <a width="250px" href="{{url('admin/doctor/status/1')}}/{{$list->id}}"
                                    class="btn btn-warning btn btn-sm"><i class="fas fa-toggle-off"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
</div>



@endsection