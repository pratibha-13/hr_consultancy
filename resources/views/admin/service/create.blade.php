@section('title')
Service |
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
        <h1>Add Service</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Service</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForms" role="form" action="{{route('service.store')}}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Blog Detail</h3>

                        </div>
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="title">Title <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="30" type="text" id="title" name="title" class="form-control" value="{{old('title')}}" placeholder="Title">
                                    @if ($errors->has('title'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="description">Description </label>
                                <div class="">
                                    <textarea  id="description" name="description" style="width: 1070px;border-color: #d2d6de"></textarea>
                                    @if ($errors->has('description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="icon">Icon <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input type="text" id="icon" name="icon" class="form-control" value="{{old('icon')}}" placeholder="Icon">
                                    @if ($errors->has('icon'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('icon') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label>Icon should be fontawesome class</label>
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

    $(document.body).on('click', "#submitBtns", function(){

        if ($("#dataForms").length){
            $("#dataForms").validate({
            errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                        "title":{
                          required : true
                        },
                        "description":{
                          required : true
                        },
                        "icon":{
                          required : true
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

$("#cancelBtn").click(function () {
    window.location.href = "{{route('service.index')}}";
});
</script>
@endsection
