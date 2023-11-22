@section('title')
Service Detail |
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
        <h1>Update Service</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Update Service</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{route('service.update',$record->service_id)}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Service Detail</h3>
                        </div>
                        <div class="box-body">
                            <input type="hidden" id="id" name="id" value="{{$record->service_id}}"/>

                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="title">Title <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="30" type="text" id="title" name="title" class="form-control" value="@if(!empty(old('title'))){{old('title')}}@else{{$record->title}}@endif" placeholder="Type Title here">
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
                                    <textarea  id="description" name="description" style="width: 1070px;border-color: #d2d6de">@if(isset($record)) @if(!empty(old('description'))){{old('description')}}@else{{$record->description}}@endif @endif</textarea>

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
                                    <input maxlength="20" type="text" id="icon" name="icon" class="form-control" value="@if(!empty(old('icon'))){{old('icon')}}@else{{$record->icon}}@endif" placeholder="Type Icon here">
                                    @if ($errors->has('icon'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('icon') }}</strong>
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

@endsection
@section('script')
    <script src="{{URL::asset('resources/assets/admin/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/prism.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/sweetalert.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/croppie.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/main.js')}}"></script>

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
