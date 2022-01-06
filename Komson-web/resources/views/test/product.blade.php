@extends('admin/layout');
@section('page_title','Product')
@section('product_select','active')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Product</h1>
            <a class="pull-right" href="{{url('admin/product/manage_product')}}"> <button type="button"
                    class="btn btn-success">Add
                    Product</button></a>
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
                            <th> Name</th>
                            <th> Brand</th>
                            <th width=150> Unit</th>
                            <th width=150> Short_desc</th>
                            <th width=150> Image</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{ $list->id}}</td>
                            <td>{{ $list->name}}</td>
                            <td>{{ $list->brand}}</td>
                            <td>{{ $list->unit}}</td>
                            <td>{{ $list->short_desc}}</td>
                            <td><img width="250px" src="{{asset('storage/media/products/'.$list->image)}}"></td>
                            <td>
                                <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}"> <i
                                        class="far fa-edit"></i></a>
                                &nbsp;
                                <a href="{{url('admin/product/delete/')}}/{{$list->id}}"><i
                                        class="fas fa-trash"></i></a>
                                &nbsp;
                                @if($list->status==1)
                                <a href="{{url('admin/product/status/0')}}/{{$list->id}}"
                                    class="btn btn-primary btn btn-sm"><i class="fas fa-toggle-on"></i></a>
                                @elseif($list->status==0)
                                <a width="250px" href="{{url('admin/product/status/1')}}/{{$list->id}}"
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