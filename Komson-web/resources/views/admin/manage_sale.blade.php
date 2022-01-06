@extends('admin/layout');
@section('sale_manu','menu-open')
@section('sale_select_add','active')
@section('page_title','manage_sale')
<style>
.hidden {
    display: none;
    width: 60px;
}
</style>
@section('container')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Manage Sale</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('manage_sale_process')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="control-label ">Doctor Name</label>
                                <select id="doctor_id" name="doctor_name" class="form-control" required>
                                    <option value="">Select Doctor</option>
                                    @foreach($doctor as $list)
                                    @if($doctor_name== $list->name)
                                    <option selected value="{{$list->name}}">
                                        @else
                                    <option value="{{$list->name}}" id="doctor_id">
                                        @endif
                                        {{$list->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="append">
                                @include('admin.add_activity')
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label ">Distributor Name</label>
                                <select id="distributor_name" name="distributor_name" class="form-control" required>
                                    <option value="">Select Distributor</option>
                                    @foreach($distributor as $list)
                                    @if($distributor_name== $list->name)
                                    <option selected value="{{$list->name}}">
                                        @else
                                    <option value="{{$list->name}}">
                                        @endif
                                        {{$list->name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="name" class="control-label ">Product Name</label>
                                <select id="product_name" name="product_name" class="form-control" required>
                                    <option value="">Select Product</option>
                                    @foreach($product as $list)
                                    @if($product_name==$list->name)
                                    <option selected value="{{$list->name}}">
                                        @else
                                    <option value="{{$list->name}}">
                                        @endif
                                        {{$list->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div> -->

                            <div class="form-group">
                                <label for="name" class="control-label ">Products</label>

                                @foreach($product as $list)
                                <div>
                                    <strong> {{$list->name}}</strong> &nbsp; &nbsp;&nbsp;
                                    <input type="checkbox" name="product_name[]" value="{{$list->name}}"
                                        {{ ( $product_name == $list->name ? 'checked' : '' )}}>&nbsp;&nbsp;
                                    <input type="number" name="quentity[]" price="{{$list->ex_factory_price}}"
                                        class="hidden" value="{{old('quentity',$quentity)}}">
                                </div>
                                </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="totel_value" class="control-label mb-1"> Totel value</label>
                                <input id="totel_value" name="totel_value" type="number"
                                    value="{{old('totel_value',$totel_value)}}" class="form-control">
                            </div>


                            <input type="hidden" name="id" value="{{$id}}">

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
$('#doctor_id').change(function() {
    var doctor_id = $(this).val();
    $.ajax({
        type: 'post',
        url: '/admin/get_activity',
        data: {
            doctor_id: doctor_id
        },
        success: function(resp) {
            $('#append').html(resp);
        },
        error(resp) {
            alert("error");
        }
    });
});
var oldvalue = 0;
$('input[type="checkbox"]').change(function() {
    $(this).next('.hidden').toggle();
    oldvalue = 0;
})
var grandtotal = 0;
$('input[type="number"]').change(function() {
    var total = $(this).val() * $(this).attr("price");
    grandtotal = total + grandtotal - oldvalue;
    oldvalue = total;
    $("#totel_value").val(grandtotal);

})
</script>
@endsection