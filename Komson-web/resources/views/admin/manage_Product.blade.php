@extends('admin/layout');
@section('product_manu','menu-open')
@section('product_select_add','active')
@section('page_title','manage_product')
@section('container')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Manage Product</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('manage_product_process')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group">
                                <label for="name" class="control-label ">Product Name</label>
                                <input id="name" name="name" type="text" value="{{old('name',$name)}}"
                                    class="form-control {{($errors->any() && $errors->first('name'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('name')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="quantity" class="control-label">Product Quantity</label>
                                <input id="quantity" name="quantity" type="number" value="{{old('quantity',$quantity)}}"
                                    class="form-control {{($errors->any() && $errors->first('quantity'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('quantity')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="generic" class="control-label">Product Generic</label>
                                <input id="generic" name="generic" type="text" value="{{old('generic',$generic)}}"
                                    class="form-control {{($errors->any() && $errors->first('generic'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('generic')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="market_price" class="control-label"> Market Price</label>
                                <input id="market_price" name="market_price" type="number"
                                    value="{{old('market_price',$market_price)}}"
                                    class="form-control {{($errors->any() && $errors->first('market_price'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('market_price')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="trade_price" class="control-label"> Trade Price</label>
                                <input id="trade_price" name="trade_price" type="number"
                                    value="{{old('trade_price',$trade_price)}}"
                                    class="form-control {{($errors->any() && $errors->first('trade_price'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('trade_price')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="ex_factory_price" class="control-label"> Ex Factory Price</label>
                                <input id="ex_factory_price" name="ex_factory_price" type="number"
                                    value="{{old('ex_factory_price',$ex_factory_price)}}"
                                    class="form-control {{($errors->any() && $errors->first('ex_factory_price'))?'is-invalid':''}} "
                                    required>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('ex_factory_price')}}</p>
                                @endif
                            </div>
                            <!-- @if(!empty($image))
                            <img id="preview-image-before-upload" width="250px"
                                src="{{asset('storage/media/products/'.$image)}}">
                            @else
                            <img id="preview-image-before-upload" width="150px"
                                src="{{asset('storage/media/user.jpg')}}">
                            @endif
                            <div class="form-group">
                                <label for="image" class="control-label">Product Image</label>
                                <input id="image" name="image" type="file"
                                    class="form-control {{($errors->any() && $errors->first('image'))?'is-invalid':''}} ">
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('image')}}</p>
                                @endif
                            </div> -->
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