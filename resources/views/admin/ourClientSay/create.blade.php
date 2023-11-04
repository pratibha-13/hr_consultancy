@section('title')
Add Our Client Say |
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
        <h1>Add Our Client Say</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Our Client Say</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForms" role="form" action="{{route('ourClientSay.store')}}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Our Client Say Detail</h3>
                            {{-- <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('our_client_say_name') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="our_client_say_name">Name <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="our_client_say_name" name="our_client_say_name" class="form-control" value="{{old('our_client_say_name')}}" placeholder="Name">
                                    @if ($errors->has('our_client_say_name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('our_client_say_name') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('profession') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="profession">Profession <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="profession" name="profession" class="form-control" value="{{old('profession')}}" placeholder="Profession">
                                    @if ($errors->has('profession'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('our_client_say_description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="our_client_say_description">Description <span class="colorRed"> *</span></label>
                                <div class="">
                                    <textarea id="our_client_say_description" name="our_client_say_description" class="form-control" value="{{old('our_client_say_description')}}" placeholder="Description"></textarea>
                                    @if ($errors->has('our_client_say_description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('our_client_say_description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="" class=" control-label post_data_label" >Image</label><span class="colorRed"> *</span> <br>
                                <div class="vc_column-inner ">
                                    <label class="cabinet center-block">
                                        <figure>
                                            <img src="{{ URL::asset('/resources/assets/img/default.png')}}" class="gambar" id="item-img-output"  name="avatar" style="max-width: 25%"/>
                                        </figure>
                                        <p></p>
                                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="item-img file" id="image" name="image"/>
                                    </label>
                                     @if ($errors->has('image'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
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

    $(document.body).on('click', "#submitBtns", function(){

        if ($("#dataForms").length){
            $("#dataForms").validate({
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
    window.location.href = "{{route('ourClientSay.index')}}";
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
      $("#brand").select2({
          placeholder: "Select Brand",
          allowClear: true,
      });
    });
</script>
@endsection
