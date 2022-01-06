@extends('admin/layout');
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')
<div class="container">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h1>Manage Product</h1>
                <a class="pull-right" href="{{url('admin/product')}}"> <button type="button"
                        class="btn btn-secondary">Back </button></a>
            </div>
        </div>
    </div>
    <div class="card-body col-md-8 offset-2 card-block">
        <form action="{{route('manage_product_process')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="control-label ">Product Name</label>
                <input id="name" name="name" type="text" value="{{old('name',$name)}}"
                    class="form-control {{($errors->any() && $errors->first('name'))?'is-invalid':''}} " required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('name')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="brand" class="control-label">Product Brand</label>
                <input id="brand" name="brand" type="text" value="{{old('brand',$brand)}}"
                    class="form-control {{($errors->any() && $errors->first('brand'))?'is-invalid':''}} " required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('brand')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="unit" class="control-label">Product Unit</label>
                <input id="unit" name="unit" type="text" value="{{old('unit',$unit)}}"
                    class="form-control {{($errors->any() && $errors->first('unit'))?'is-invalid':''}} " required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('unit')}}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="short_desc" class="control-label">Short_desc</label>
                <textarea id="short_desc" name="short_desc" type="text"
                    class="form-control {{($errors->any() && $errors->first('short_desc'))?'is-invalid':''}} " rows="3"
                    required>{{old('short_desc',$short_desc)}}</textarea>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('short_desc')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="desc" class="control-label">Desc</label>
                <textarea id="desc" name="desc" type="text"
                    class="form-control {{($errors->any() && $errors->first('desc'))?'is-invalid':''}} " rows="5"
                    required>{{old('desc',$desc)}} </textarea>

                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('desc')}}</p>
                @endif
            </div>
            @if(!empty($image))
            <img id="preview-image-before-upload" width="250px" src="{{asset('storage/media/products/'.$image)}}">
            @else
            <img id="preview-image-before-upload" width="150px" src="{{asset('storage/media/user.jpg')}}">
            @endif



            <div class="form-group">
                <label for="image" class="control-label">Product Image</label>
                <input id="image" name="image" type="file"
                    class="form-control {{($errors->any() && $errors->first('image'))?'is-invalid':''}} ">
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('image')}}</p>
                @endif
            </div>
            <input type="hidden" name="id" value="{{$id}}">
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    Submit
                </button>
            </div>
        </form>

    </div>
</div>
</div>
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