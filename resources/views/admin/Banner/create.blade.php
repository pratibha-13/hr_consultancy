@section('title')
Add New Banner |
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add New Banner</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Banner</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{route('banner.store')}}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Banner Detail</h3>
                            {{-- <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="title">Title <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="title" name="title" class="form-control" value="{{old('title')}}" placeholder="Type title here">
                                    @if ($errors->has('title'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('banner_description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="title">Banner Description <span class="colorRed"> *</span></label>
                                <div class="">
                                    <textarea id="banner_description" name="banner_description" class="form-control" value="{{old('banner_description')}}" placeholder="Banner Description"></textarea>
                                    @if ($errors->has('banner_description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('banner_description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="link">Link <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{old('link')}}"/>
                                    @if ($errors->has('link'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                              <div class="form-group">
                                <label for="" class=" control-label post_data_label" >Image</label><span class="colorRed"> *</span> <br>
                                <div class="vc_column-inner ">
                                    <label class="cabinet center-block">
                                        <figure>
                                            <img src="{{ URL::asset('/resources/assets/img/default.png')}}" class="gambar" id="item-img-output"  name="avatar" />
                                        </figure>
                                        <p></p>
                                        <input type="hidden" name="main_image" value="" id="main_image" style="">
                                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="item-img file" name="image"/>
                                    </label>

                                    <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  ">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div id="upload-demo" class="center-block"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default close_crop" id="cancelCropBtn" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-default" id="Flip">Flip</button>
                                                    {{-- <button class="btn btn-default" id="rotate" data-deg="-90">Rotate</button> --}}
                                                    <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        /* height: 100%; */
        max-width: 25%;
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

    $(document.body).on('click', "#submitBtn", function(){
        if ($("#dataForm").length){
            $("#dataForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                      "title":{
                          required:true,
                          minlength: 2,
                          maxlength: 20
                      },
                       "link":{
                          required:true,
                      },
                      "main_image" : {
                            required : true,
                            // extension : "png|PNG|jpeg|JPEG|jpg|JPG|svg|SVG"
                        },
                        "banner_description":{
                          required : true,
                        },

                  },
                  messages: {

                      "title":{
                          required:"Please Enter Title",
                      },
                      "link":{
                          required:"Please Enter Link",
                      },
                       "main_image" :{
                            required : "Image is required.",
                        },
                        "banner_description" :{
                             required : "Description is required.",
                         },
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
    window.location.href = "{{route('banner.index')}}";
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
                            $('.upload-demo').addClass('ready');
                            $('#cropImagePop').modal('show');
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

        $uploadCrop1 = $('#upload-demo').croppie({
            viewport: {
            width: 480,
            height: 270,
            // type: 'square'
            },
            enableOrientation: true,
            enforceBoundary: true,
            enableExif: true
        });
        $('#cropImagePop').on('shown.bs.modal', function(){
            // alert('Shown pop');
            $uploadCrop1.croppie('bind', {
                url: rawImg
                }).then(function(){
                    // console.log('jQuery bind complete');
                    $("span#main_image-error").hide();
                });
        });
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
        $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop1.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: {width: 480, height: 270}
            }).then(function (resp) {
                $('#item-img-output').attr('src', resp);
                $('#main_image').attr('value', resp);
                $('#cropImagePop').modal('hide');
            });
        });
    // End upload preview image
</script>
@endsection
