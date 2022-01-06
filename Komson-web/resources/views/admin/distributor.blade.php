@extends('admin/layout');
@section('distributor_manu','menu-open')
@section('distributor_select','active')
@section('page_title','Distributors')
@section('container')

<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Distributors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">distributors</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->
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
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title">View distributors</h3> -->
                            <a href="{{url('admin/distributor/manage_distributor')}}"> <button type="button"
                                    class="btn btn-success">Add
                                    Distributor</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Area </th>
                                        <th>Sale</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody>
                                    @foreach($data as $list)
                                    <tr>
                                        <td>{{ $list->id}}</td>
                                        <td>{{ $list->name}}</td>
                                        <td>{{ $list->area}}</td>
                                        <td>{{ $list->sale}}</td>
                                        <td>
                                            <a href="{{url('admin/distributor/manage_distributor/')}}/{{$list->id}}"> <i
                                                    class="far fa-edit"></i></a>
                                            &nbsp;
                                            <a href="{{url('admin/distributor/delete/')}}/{{$list->id}}"><i
                                                    class="fas fa-trash"></i></a>
                                            &nbsp;
                                            @if($list->status==1)
                                            <a href="{{url('admin/distributor/status/0')}}/{{$list->id}}"
                                                class="btn btn-primary btn btn-sm"><i class="fas fa-toggle-on"></i></a>
                                            @elseif($list->status==0)
                                            <a width="250px" href="{{url('admin/distributor/status/1')}}/{{$list->id}}"
                                                class="btn btn-warning btn btn-sm"><i class="fas fa-toggle-off"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Area </th>
                                        <th>Sale</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->

    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>


@endsection