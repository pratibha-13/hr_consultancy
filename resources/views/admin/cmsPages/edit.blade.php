@extends('admin.layouts.app') @section('content')

@section('title') {{$action}} Page |@endsection
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{$action}} Page</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
             <li><a href="{{url('admin/pages')}}"> Pages</a></li>
            <li class="active">{{$action}} Page</li>
        </ol>
    </section>
    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <!-- Horizontal Form -->
                <div class="box ">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="col-sm-12">
                        <form class="" id="PageForm" action="{{url($url)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method($method)
                            <div class="box-body">

                                    <div class="form-group {{ $errors->has('page_title') ? ' has-error' : '' }}">
                                        <label  class=" control-label" for="page_title">Title <span class="colorRed"> *</span></label>
                                        <div class="">
                                            <input type="text" class="form-control" id="page_title" name="page_title" placeholder="" value="@if(isset($pages))  @if(!empty(old('page_title'))){{old('page_title')}}@else{{$pages->page_title}}@endif @endif"/>
                                            <input type="hidden"  id="cms_page_id" name="cms_page_id" value="@if(isset($pages)) {{$pages->cms_page_id}} @endif"/> 
                                            @if ($errors->has('page_title'))
                                            <span class="help-block alert alert-danger">
                                                <strong>{{ $errors->first('page_title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                                        <label  class=" control-label" for="slug">Slug</label>
                                        <div class="">
                                            <input  class="form-control" id="slug" name="slug" value=" @if(isset($pages)) @if(!empty(old('slug'))){{old('slug')}}@else{{$pages->slug}}@endif @endif"/>
                                            @if ($errors->has('metaKeyword'))
                                            <span class="help-block alert alert-danger">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label  class=" control-label" for="content">Content <span class="colorRed"> *</span></label>
                                        <div class="">
                                            <textarea id="content" name="content">@if(isset($pages)) @if(!empty(old('content'))){{old('content')}}@else{{$pages->content}}@endif @endif</textarea>
                                            @if ($errors->has('content'))
                                                <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('metaKeyword') ? ' has-error' : '' }}">
                                        <label  class=" control-label" for="metaKeyword">Meta Keyword</label>
                                        <div class="">
                                            <textarea class="form-control" id="metaKeyword" name="metaKeyword">@if(isset($pages)) @if(!empty(old('metaKeyword'))){{old('metaKeyword')}}@else{{$pages->metaKeyword}}@endif @endif</textarea>
                                            @if ($errors->has('metaKeyword'))
                                            <span class="help-block alert alert-danger">
                                                <strong>{{ $errors->first('metaKeyword') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('metaDescription') ? ' has-error' : '' }}">
                                        <label  class=" control-label" for="metaDescription">Meta Description</label>
                                        <div class="">
                                            <textarea class="form-control" id="metaDescription" name="metaDescription">@if(isset($pages)) @if(!empty(old('metaDescription'))){{old('metaDescription')}}@else{{$pages->metaDescription}}@endif @endif</textarea>
                                            @if ($errors->has('metaDescription'))
                                            <span class="help-block alert alert-danger">
                                                <strong>{{ $errors->first('metaDescription') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                            <!-- /.box-body -->
                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>

                            <div class="box-footer">
                                <button type="submit" id="PageBtn" class="btn btn-info pull-right" style="margin-left: 20px;">{{$action}}</button>
                                <button type="button" class="btn btn-default pull-right" id="cancelBtn">Back</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/prism.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/sweetalert.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/croppie.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/custom.css')}}">
@endsection

@section('script')
@if(Session::has('message'))
    <script>
        $(function() {
        toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
    </script>
@endif

<script src="{{URL::asset('/resources/assets/custom/image_cropping/prism.js')}}"></script>
<script src="{{URL::asset('/resources/assets/custom/image_cropping/sweetalert.js')}}"></script>
<script src="{{URL::asset('/resources/assets/custom/image_cropping/croppie.js')}}"></script>
<script src="{{URL::asset('/resources/assets/custom/image_cropping/main.js')}}"></script>

<script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/jquery.validate.js')}}"></script>
<script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/additional-methods.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<script>
    var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}
    function convertToSlug(Text)
{
    return Text
        .toLowerCase().trim()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}
    $(function () {
        CKEDITOR.replace('content');
    });


    $("#cancelBtn").click(function () {
        window.location.href = "{{url('admin/pages')}}";
    });
    $("#page_title").on('keyup',function(){
         $("#slug").val(slug($(this).val()));
       // $(this).css("background-color", "#FFFFFF");
    })
    $(document.body).on('click', "#PageBtn", function(){
        
        if ($("#PageForm").length){
            $("#PageForm").validate({
            errorElement: 'span',
                errorClass: 'text-red',
                ignore: [],
                rules: {
                    "page_title":{
                        required:true,
                    },
                    "content":{
                        // required:true,
                    },
                    
                },
                messages: {
                    'page_title':{
                        required:'Please enter page title.',
                    },
                    'content':{
                        required:'Please write content description.',
                    }
                },
                errorPlacement: function(error, element) {
                error.insertAfter(element.closest(".form-control"));
                },
            });
        }
    });
</script>

@endsection