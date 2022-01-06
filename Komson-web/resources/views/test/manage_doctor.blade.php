@extends('admin/layout');
@section('page_title','Manage doctor')
@section('doctor_select','active')
@section('container')
<div class="container">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header">
                <h1>Manage Doctor</h1>
                <a class="pull-right" href="{{url('admin/doctor')}}"> <button type="button"
                        class="btn btn-secondary">Back </button></a>
            </div>
        </div>
    </div>

    <div class="card-body col-md-8 offset-2 card-block">
        <form action="{{route('manage_doctor_process')}}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="form-group">
                <label for="brick_name" class="control-label ">Brick brick_name</label>
                <input id="brick_name" name="brick_name" type="text" value="{{old('brick_name',$brick_name)}}"
                    class="form-control {{($errors->any() && $errors->first('brick_name'))?'is-invalid':''}} " required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('brick_name')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="pmdc_no" class="control-label ">PMDC NO.</label>
                <input id="pmdc_no" name="pmdc_no" type="number" value="{{old('pmdc_no',$pmdc_no)}}"
                    class="form-control {{($errors->any() && $errors->first('pmdc_no'))?'is-invalid':''}} " required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('pmdc_no')}}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="name" class="control-label ">Doctor Name</label>
                <input id="name" name="name" type="text" value="{{old('name',$name)}}"
                    class="form-control {{($errors->any() && $errors->first('name'))?'is-invalid':''}} ">
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('name')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="dateof_birth" class="control-label ">Date of Birth</label>
                <input id="dateof_birth" name="dateof_birth" type="date" value="{{old('dateof_birth',$dateof_birth)}}"
                    class="form-control {{($errors->any() && $errors->first('dateof_birth'))?'is-invalid':''}} "
                    required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('dateof_birth')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="cnic" class="control-label ">CNIC NO.</label>
                <input id="cnic" name="cnic" type="text" value="{{old('cnic',$cnic)}}"
                    class="form-control {{($errors->any() && $errors->first('cnic'))?'is-invalid':''}} " required
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('cnic')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="mobile" class="control-label ">Mobile NO.</label>
                <input id="mobile" name="mobile" type="text" value="{{old('mobile',$mobile)}}"
                    class="form-control {{($errors->any() && $errors->first('mobile'))?'is-invalid':''}} " required
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('mobile')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="qualification" class="control-label">Qualification</label>
                <input id="qualification" name="qualification" type="text"
                    value="{{old('qualification',$qualification)}}"
                    class="form-control {{($errors->any() && $errors->first('qualification'))?'is-invalid':''}} "
                    required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('qualification')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="designation" class="control-label"> Designation</label>
                <input id="designation" name="designation" type="text" value="{{old('designation',$designation)}}"
                    class="form-control {{($errors->any() && $errors->first('designation'))?'is-invalid':''}} "
                    required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('designation')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="morning_address" class="control-label"> Morning_address</label>
                <input id="morning_address" name="morning_address" type="text"
                    value="{{old('morning_address',$morning_address)}}"
                    class="form-control {{($errors->any() && $errors->first('morning_address'))?'is-invalid':''}} "
                    required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('morning_address')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="evening_address" class="control-label"> evening_address</label>
                <input id="evening_address" name="evening_address" type="text"
                    value="{{old('evening_address',$evening_address)}}"
                    class="form-control {{($errors->any() && $errors->first('evening_address'))?'is-invalid':''}} "
                    required>
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('evening_address')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="par_day_patients" class="control-label ">Par_day_patients NO.</label>
                <input id="par_day_patients" name="par_day_patients" type="text"
                    value="{{old('par_day_patients',$par_day_patients)}}"
                    class="form-control {{($errors->any() && $errors->first('par_day_patients'))?'is-invalid':''}} "
                    required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                @if($errors->any())
                <p class="invalid-feedback">{{$errors->first('par_day_patients')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="select_type" class="control-label">select type</label>
                <select name="select_type" id="select_type" class="form-control ">
                    <option value="purchaser">Peblisher</option>
                    <option value="prescriber">Prescriber</option>
                </select>
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