@section('title')
Home Page Slider Detail |
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/lightbox2-master/dist/css/lightbox.css')}}">
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove
{
    color: #000 !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice
{
    color: #000;
}
.select2-container--default .select2-search--inline .select2-search__field
{
    padding: 2px 8px !important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple
{
    border: solid #d2d6de 1px !important;
}
.select2-container--default .select2-selection--multiple
{
    border-radius: 0px !important;
}
</style>
@endsection

@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Update Home Page Slider</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Update Home Page Slider</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{route('homePageSlider.update',$result->home_page_slider_id)}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Home Page Slider Detail</h3>
                        </div>
                        <div class="box-body">
                            <input type="hidden" id="id" name="id" value="{{$result->home_page_slider_id}}"/>

                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="title">Title</label>
                                <div class="">
                                    <input maxlength="100" type="text" id="title" name="title" class="form-control" value="@if(!empty(old('title'))){{old('title')}}@else{{$result->title}}@endif" placeholder="Type title here">
                                    @if ($errors->has('title'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="short_description"> Short Description </label>
                                <div class="">
                                    <textarea id="short_description" name="short_description" class="form-control" value="{{old('short_description')}}" placeholder=" Description">{{$result->short_description}}</textarea>
                                    @if ($errors->has('short_description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('short_description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="category">Category <span class="colorRed"> *</span></label>
                                    <div class="">
                                    <?php
                                        $chkk = explode(',', $result->category);
                                    ?>
                                    <select name="category" class="form-control categoryForProduct" id="category">
                                      <option></option>
                                      @foreach($category as $value)
                                      <option value="{{ $value->category_id }}" @if(in_array($value->category_id, $chkk)) selected @endif>{{ $value->name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                            </div>

                            <div class="form-group {{ $errors->has('sub_category') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="sub_category">Sub Category</label>
                                    <div class="">
                                    <?php
                                        $chkkk = explode(',', $result->sub_category);
                                    ?>

                                    <select name="sub_category" class="form-control" id="sub_category">
                                      <option></option>
                                      @foreach($subCategory as $value)
                                      <option value="{{ $value['sub_category_id'] }}" @if(in_array($value['sub_category_id'], $chkkk)) selected @endif>{{ $value['name'] }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('sub_category'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('sub_category') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                            </div>

                            <div class="form-group {{ $errors->has('product') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="product">Product</label>
                                    <div class="">
                                    <?php
                                        $chkk = explode(',', $result->product);
                                    ?>
                                    <select name="product" class="form-control productForCat" id="product">
                                      <option></option>
                                      @foreach($product as $value)
                                      <option value="{{ $value->product_id }}" @if(in_array($value->product_id, $chkk)) selected @endif>{{ $value->product_name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('product'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                            </div>


                            <div class="form-group">
                                <label for="" class=" control-label post_data_label" >Image</label><span class="colorRed"> *</span> <br>
                                <div class="vc_column-inner ">
                                    <label class="cabinet center-block">
                                        <figure>
                                            <img src="{{ $result->image? $result->image:URL::asset('/resources/assets/img/default.png')}}" class="gambar" id="item-img-output"  name="avatar"  style="height:250px;"/>
                                        </figure>
                                        <p></p>

                                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="item-img file " name="image" id="image"/>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                            <label>Slider Selection <span class="colorRed"> *</span></label>
                            </div>
                            <div class="form-group {{ $errors->has('slider_selection') ? ' has-error' : '' }}">
                                <input type="radio" name="slider_selection" value="main" {{ $result->slider_selection=="main"? 'checked':'' }}> Main Slider</br>
                                <label>Image should be 1920*500 Size</label>
                            </div>
                            <div class="form-group {{ $errors->has('slider_selection') ? ' has-error' : '' }}">
                                <input type="radio" name="slider_selection" value="first" {{ $result->slider_selection=="first"? 'checked':'' }}> First Slider</br>
                                <label>Image should be 540*300 Size</label>
                            </div>
                            <div class="form-group {{ $errors->has('slider_selection') ? ' has-error' : '' }}">
                                <input type="radio" name="slider_selection" value="second" {{ $result->slider_selection=="second"? 'checked':'' }}> Second Slider</br>
                                <label>Image should be 420*460 Size</label>
                            </div>
                            <div class="form-group {{ $errors->has('slider_selection') ? ' has-error' : '' }}">
                                <input type="radio" name="slider_selection" value="third" {{ $result->slider_selection=="third"? 'checked':'' }}> Third Slider</br>
                                <label>Image should be 255*350 Size</label>
                            </div>

                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                            <div class="col-sm-12">
                                <div class="" style="border-top:0">
                                    <div class="box-footer">
                                        <button type="submit" id="submitBtn" class="btn btn-info pull-right" style="margin-left: 20px;">Submit</button>
                                        <button type="button" id="cancelBtn" class="btn btn-default pull-right">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <!-- /.col -->
        </div>
    </section>
</div>
@endsection
@section('css')

<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/prism.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/sweetalert.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/croppie.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/lightbox2-master/dist/css/lightbox.css')}}">
<style>
   .profile_image_showInput {
        opacity: 1;
        cursor: pointer;
        display: block;
        margin-top: 15px;
        height: 30px;
        width: 100% !important;
        background-color: #269abc;
    }
    .changeImage {
        background: #269abc none repeat scroll 0 0;
        border-radius: 0px;
        pointer-events: none;
        display: block;
        padding: 5px 15px;
        bottom: 0;
        color: #fff;
        margin-top: -30px !important;
        margin: 0 auto;
        width: 100%;
        float: left;
        left: 0;
        position: relative;
        text-align: center;
    }
     #upload-demo{
        height: 500px;
    }
    .old_profile_imageSub, #item-img-output{
        max-width: 25% !important;
    }
    .control-label{
      display: inline-block;
    }
</style>
@endsection
@section('script')
    <script src="{{URL::asset('resources/assets/admin/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/prism.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/sweetalert.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/croppie.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/main.js')}}"></script>
    <!-- <script src="{{URL::asset('/resources/assets/custom/image_cropping/exif.js')}}"></script> -->

    @if(Session::has('message'))
        <script>
        $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
        </script>
    @endif
<script>
$(document).ajaxStart(function() { Pace.restart(); });
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var SITE_URL = "<?php echo URL::to('/'); ?>";

    $(document.body).on('click', "#submitBtn", function(){
        if ($("#dataForm").length){
            $("#dataForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {


                  },
                  messages: {

                    },
                    errorPlacement: function(error, element) {
                        if(element.is('select')){
                            error.appendTo(element.closest("div"));
                        }else{
                            error.insertAfter(element.closest(".form-control"));
                        }
                    },
            });
        }
    });
$("#cancelBtn").click(function () {
    window.location.href = "{{route('homePageSlider.index')}}";
});
</script>
<script type="text/javascript">
    // Start upload preview image
    var FLIP = 2;
    var NORMAL = 1;
    var orientation = NORMAL;
    var $uploadCrop1, tempFilename, rawImg, imageId;
    var fileTypes = ['jpg', 'jpeg', 'png'];
        function readFile(input) {
            if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var file = input.files[0]; // Get your file here
                    var fileExt = file.type.split('/')[1]; // Get the file extension
                    if (fileTypes.indexOf(fileExt) !== -1) {
                        reader.onload = function (e) {
                            // $('.upload-demo').addClass('ready');
                            // $('#cropImagePop').modal('show');
                            rawImg = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);

                    }else{
                        swal("Only JPEG, PNG, JPG file types are supported");
                        $(".item-img").val("");
                    }
                }
                else {
                swal("Please select an image");
                $("#main_image").val("");
                $("#item-img-output").attr("src",SITE_URL + "/resources/assets/img/default.png");

            }
        }

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#item-img-output').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

    $(document).ready(function() {
      $("#category").select2({
          placeholder: "Select Category",
          allowClear: true,
      });
    });
    $(document).ready(function() {
      $("#sub_category").select2({
          placeholder: "Select Sub Category",
          allowClear: true,
      });
    });
    $(document).ready(function() {
      $("#product").select2({
          placeholder: "Select Product",
          allowClear: true,
      });
    });

    $('#category').on('change', function(){
        var id = $('#category').val();

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getSubCategory',
            data: {
                id
            },
            success: function(data) {
                $('#sub_category').html(data);
            }
        });
        });
        $('.categoryForProduct').on('change', function(){
        var id = $('.categoryForProduct').val();

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getProduct',
            data: {
                id
            },
            success: function(data) {
                $('.productForCat').html(data);
            }
        });
        });

        $('#sub_category').on('change', function(){
        var id = $('#sub_category').val();

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getProductForSub',
            data: {
                id
            },
            success: function(data) {
                $('#product').html(data);
            }
        });
        });
</script>
@endsection
