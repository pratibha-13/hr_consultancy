@section('title')
Add New Product |
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
        <h1>Add New Product</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Product</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForms" role="form" action="{{route('product.store')}}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product Detail</h3>
                            {{-- <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_name">Product Name <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="product_name" name="product_name" class="form-control" value="{{old('product_name')}}" placeholder="Product Name">
                                    @if ($errors->has('product_name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_name') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="category">Category <span class="colorRed"> *</span></label>
                                    <div class="">

                                    <select name="category" class="form-control" id="category" data-old="{{old('category')}}">
                                      <option></option>
                                      @foreach($category as $value)
                                      <option value="{{ $value->category_id }}">{{ $value->name}}</option>
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
                                    <div>
                                        <select name="sub_category[]" class="form-control" id="sub_category" multiple data-old="{{old('sub_category')}}">

                                      @foreach($subCategory as $value)
                                      <option value="{{ $value->sub_category_id }}">{{ $value->name}}</option>
                                      @endforeach
                                    </select>

                                        @if ($errors->has('sub_category'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('sub_category') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="color">Color </label>
                                    <div class="">

                                    <select name="color[]" class="form-control" id="color" multiple data-old="{{old('color')}}">

                                      @foreach($color as $value)
                                      <option value="{{ $value->color_id }}">{{ $value->color_name}}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('color'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="size">Size </label>
                                    <div class="">

                                    <select name="size[]" class="form-control" id="size" multiple data-old="{{old('size')}}">

                                      @foreach($size as $value)
                                      <option value="{{ $value->size_id }}">{{ $value->size_name}}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('size'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>

                            <div class="form-group {{ $errors->has('customer_product_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="customer_product_price">Customer Product Price <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="customer_product_price" name="customer_product_price" class="form-control" value="{{old('customer_product_price')}}" placeholder="Product Price">
                                    @if ($errors->has('customer_product_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('customer_product_price') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('reseller_product_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="reseller_product_price">Reseller Product Price </label>
                                <div class="">
                                    <input maxlength="100" type="text" id="reseller_product_price" name="reseller_product_price" class="form-control" value="{{old('reseller_product_price')}}" placeholder="Product Price">
                                    @if ($errors->has('reseller_product_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('reseller_product_price') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('offer_customer_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="offer_customer_price">Offer Customer Price </label>
                                <div class="">
                                    <input maxlength="100" type="text" id="offer_customer_price" name="offer_customer_price" class="form-control" value="{{old('offer_customer_price')}}" placeholder="Product Price">
                                    @if ($errors->has('offer_customer_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('offer_customer_price') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('offer_reseller_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="offer_reseller_price">Offer Reseller Price </label>
                                <div class="">
                                    <input maxlength="100" type="text" id="offer_reseller_price" name="offer_reseller_price" class="form-control" value="{{old('offer_reseller_price')}}" placeholder="Product Price">
                                    @if ($errors->has('offer_reseller_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('offer_reseller_price') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('quantity_in_stock') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="quantity_in_stock">Quantity In Stock</label>
                                <div class="">
                                    <input maxlength="100" type="text" id="quantity_in_stock" name="quantity_in_stock" class="form-control" value="{{old('quantity_in_stock')}}" placeholder="Quantity in stock">
                                    @if ($errors->has('quantity_in_stock'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('quantity_in_stock') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('product_short_description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_short_description">Short Description </label>
                                <div class="">
                                    <textarea id="product_short_description" name="product_short_description" class="form-control" value="{{old('product_short_description')}}" placeholder="Description">{{ old('product_short_description') }}</textarea>
                                    @if ($errors->has('product_short_description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_short_description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>
                            <div class="form-group {{ $errors->has('product_long_description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_long_description">Long Description </label>
                                <div class="">
                                    <!-- <textarea id="product_long_description" name="product_long_description" class="form-control" value="{{old('product_long_description')}}" placeholder="Description">{{ old('product_long_description') }}</textarea> -->

                                    <textarea id="product_long_description" name="product_long_description"></textarea>

                                    @if ($errors->has('product_long_description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_long_description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                              <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="" class=" control-label post_data_label" >Product Image</label><span class="colorRed"> *</span> <br>
                                <div class="vc_column-inner ">
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control"  id="image" name="image[]" multiple>
                                     @if ($errors->has('image'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                              </div>

                              <div class="form-group {{ $errors->has('product_video') ? ' has-error' : '' }}">
                                <label for="" class=" control-label post_data_label" >Product Video</label> <br>
                                <div class="vc_column-inner ">
                                    <input type="file" accept="video/mp4" class="form-control"  id="product_video" name="product_video[]" multiple>
                                     @if ($errors->has('product_video'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_video') }}</strong>
                                    </span>
                                    @endif
                                </div>
                              </div>

                            <div class="form-group {{ $errors->has('new_arrival') ? ' has-error' : '' }}">
                                <input type="checkbox" name="new_arrival" value="new_arrival"> New Arrival
                            </div>
                            <div class="form-group {{ $errors->has('best_sellers') ? ' has-error' : '' }}">
                                <input type="checkbox" name="best_sellers" value="best_sellers"> Best Sellers
                            </div>
                            <div class="form-group {{ $errors->has('featured') ? ' has-error' : '' }}">
                                <input type="checkbox" name="featured" value="featured"> Featured
                            </div>
                            <div class="form-group {{ $errors->has('special_offer') ? ' has-error' : '' }}">
                                <input type="checkbox" name="special_offer" value="special_offer"> Special Offer
                            </div>

                            <div class="form-group {{ $errors->has('product_priority') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_priority"> Priority </label>
                                <div class="">
                                    <input maxlength="100" type="text" id="product_priority" name="product_priority" class="form-control priority" value="{{old('product_priority')}}" placeholder="Product Priority">
                                    @if ($errors->has('product_priority'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_priority') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                            <div class="col-sm-12">
                                <div class="" style="border-top:0">
                                    <div class="box-footer">
                                        <button type="submit" id="submitBtns" class="btn btn-info pull-right" style="margin-left: 20px;">Submit</button>
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
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">
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
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/prism.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/sweetalert.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/croppie.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/main.js')}}"></script>
    {{-- <script src="{{URL::asset('/resources/assets/custom/image_cropping/exif.js')}}"></script> --}}
    <script src="{{URL::asset('resources/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

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
    $.validator.addMethod("lessthan", function(value, element) {
        var customer_product_price = $("#customer_product_price").val();
        if(customer_product_price) {
            customer_product_price = parseInt(customer_product_price);
        }
        if(value) {
            value = parseInt(value);
        }
        if(value && customer_product_price && (value > customer_product_price)) {
         return false;
        }
        return true;
    }, "offer price should be less than real price.");

    $.validator.addMethod("lessthan1", function(value1, element1) {
        var reseller_product_price = $("#reseller_product_price").val();
        if(reseller_product_price) {
            reseller_product_price = parseInt(reseller_product_price);
        }
        if(value1) {
            value1 = parseInt(value1);
        }
        if(value1 && reseller_product_price && (value1 > reseller_product_price)) {
         return false;
        }
        return true;
    }, "offer price should be less than real price.");

    $(document.body).on('click', "#submitBtns", function(){

        if ($("#dataForms").length){
            $("#dataForms").validate({
            errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                        "product_name":{
                          required : true
                        },
                        "category":{
                          required : true
                        },
                        "customer_product_price":{
                          required : true
                        },
                        "image[]":{
                          required : true,
                          extension: "jpg|jpeg|png|ico|bmp"
                        },
                        "video[]":{
                          extension: "mp4"
                        },
                        "offer_customer_price":{
                          lessthan : true,
                      },
                      "offer_reseller_price":{
                          lessthan : true,
                      },

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

    $(document).ready(function () {
        $(".priority").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).ready(function () {
        $(".priority").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).ready(function () {
        $("#customer_product_price").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
    $(document).ready(function () {
        $("#offer_customer_price").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
    $(document).ready(function () {
        $("#reseller_product_price").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
    $(document).ready(function () {
        $("#offer_reseller_price").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
    $(document).ready(function () {
        $("#quantity_in_stock").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

$("#cancelBtn").click(function () {
    window.location.href = "{{route('product.index')}}";
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


        $('#Flip').click(function() {
            orientation = orientation == NORMAL ? FLIP : NORMAL;
            $uploadCrop1.croppie('bind', {
                url: rawImg,
                orientation: orientation,
            });
        });
        $('#rotate').click(function() {
            $uploadCrop1.croppie('rotate', parseInt($(this).data('deg')));
        });
        $('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
        $('#cancelCropBtn').data('id', imageId); readFile(this); });
        $("#cancelCropBtn").click(function(){
           $(".item-img").val("");
           $("#main_image").val("");
           $("#item-img-output").attr("src",SITE_URL + "/resources/assets/img/default.png");
        });

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
          placeholder: "Select SubCategory",
          allowClear: true,
      });
    });
    $(document).ready(function() {
      $("#brand").select2({
          placeholder: "Select Brand",
          allowClear: true,
      });
    });
    $(document).ready(function() {
      $("#color").select2({
          placeholder: "Select Color",
          allowClear: true,
      });
    });
    $(document).ready(function() {
      $("#size").select2({
          placeholder: "Select Size",
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
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getcolor',
            data: {
                id
            },
            success: function(data) {
                $('#color').html(data);
            }
        });
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getsize',
            data: {
                id
            },
            success: function(data) {
                $('#size').html(data);
            }
        });
        });

        $(function () {
        CKEDITOR.replace('product_long_description');
    });

</script>
@endsection
