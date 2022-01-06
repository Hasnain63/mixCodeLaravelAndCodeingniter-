@extends('admin/layout');
@section('distributor_manu','menu-open')
@section('distributor_select_add','active')
@section('page_title','manage_distributor')
@section('container')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Manage Distributor</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('manage_distributor_process')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group">
                                <label for="name" class="control-label ">Distributor Name</label>
                                <input id="name" name="name" type="text" value="{{old('name',$name)}}"
                                    class="form-control {{($errors->any() && $errors->first('name'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('name')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="area" class="control-label">Distributor Area</label>
                                <input id="area" name="area" type="number" value="{{old('area',$area)}}"
                                    class="form-control {{($errors->any() && $errors->first('area'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('area')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sale" class="control-label">Distributor Sale</label>
                                <input id="sale" name="sale" type="text" value="{{old('sale',$sale)}}"
                                    class="form-control {{($errors->any() && $errors->first('sale'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('sale')}}</p>
                                @endif
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
$(document).ready(function(e) {

    $('#image').change(function() {

        let reader = new FileReader();

        reader.onload = (e) => {

            $('#preview-image-before-upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });

});
</script>
@endsection