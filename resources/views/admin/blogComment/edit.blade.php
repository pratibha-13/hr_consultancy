@section('title')
Blog Comment Detail |
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
        <h1>Update Blog Comment</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Update Blog Comment</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{route('blogComment.update',$record->blog_comment_id)}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Blog Comment Detail</h3>
                        </div>
                        <div class="box-body">
                            <input type="hidden" id="id" name="id" value="{{$record->blog_comment_id}}"/>

                            <div class="form-group">
                                <label  class=" control-label" for="">Blog Title <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="" name="blog_id" class="form-control" value="{{$blog->blog_title}}" readonly>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="user_name">User Name <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="user_name" name="user_name" class="form-control" value="@if(!empty(old('user_name'))){{old('user_name')}}@else{{$record->user_name}}@endif" readonly>
                                    @if ($errors->has('user_name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="email">Blog Title <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="email" name="email" class="form-control" value="@if(!empty(old('email'))){{old('email')}}@else{{$record->email}}@endif" readonly>
                                    @if ($errors->has('email'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('comments') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="comments">Blog Title <span class="colorRed"> *</span></label>
                                <div class="">
                                <textarea id="comments" name="comments">@if(isset($record)) @if(!empty(old('comments'))){{old('comments')}}@else{{$record->comments}}@endif @endif</textarea>
                                 @if ($errors->has('comments'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                    @endif
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

<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/prism.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/sweetalert.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/croppie.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/lightbox2-master/dist/css/lightbox.css')}}">
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
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
    window.location.href = "{{route('blogComment.index')}}";
});
</script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('comments');
    });
</script>
@endsection
