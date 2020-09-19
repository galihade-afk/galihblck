@extends('layouts.admin')
@section('content')

<div class="container">
<form class="form1" role="form" action="{{url('/admin/profile/update')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <div class="col-sm-4 col-form-label">
        <h3 class="">Profile Information</h3>

        <p class="">
            Update your account's profile information and email address.
        </p>
        </div>
      <div class="col-sm-8  form-group">
        <input type="hidden" name="id" value="{{auth()->user()->id}}">
        <label for="" class="col-sm-2">Name</label>
        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{auth()->user()->name}}">

        <label for="" class="col-sm-2 col-form-label">Email</label>
        <input type="Email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{auth()->user()->email}}">

        <label for="" class="col-sm-2 col-form-label">Address</label>
        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3">{{auth()->user()->address}}</textarea>

        <label for="" class="col-sm-2 col-form-label">Phone number</label>
        <input type="number" name="phone" class="form-control" id="inputPhone" placeholder="08.." value="{{auth()->user()->phone}}">

        <label  class="col-md-3">Select Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="img" class="custom-file-input profile-image" id="img">
                <label class="custom-file-label" for="exampleInputFile"> {{auth()->user()->img}}</label>
            </div>
        </div>
        <div class="img1">
        <img alt="..." src="{{asset('storage/user/'.auth()->user()->img)}}" class="img-thumbnail mt-2" width="100" height="100">
        </div>
        <button type="submit" class="btn btn-secondary mt-2">Save</button>
        {{-- <p class="save">Saved</p> --}}
      </div>
    </div>
    
</form>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('.textarea').summernote();
        bsCustomFileInput.init();
        // function preview image
        function readURL(input)
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader();                    
                reader.onload = function(e)
                {
                    
                    $(".img1").find("img").attr('src', e.target.result);
                }                    
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".profile-image").change(function()
        {
            readURL(this);
            
        });

    });
</script> 
@endsection