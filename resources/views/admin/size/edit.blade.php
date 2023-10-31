@section('title')
Size |
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Size</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Size</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{url('admin/size')}}/{{$size->size_id}}" method="post" enctype="multipart/form-data" >
                {{method_field('PUT')}}
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Size Detail</h3>
                            {{-- <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="box-body">
                        <div class="form-group {{ $errors->has('category_wise_size') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="category_wise_size">Category <span class="colorRed"> *</span></label>
                                <div>
                                    <select name="category_wise_size" id="category_wise_size" class="form-control">
                                       
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}" @if($category->category_id == $size->category_wise_size) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('category_wise_size'))
                                <span class="help-block alert alert-danger">
                                    <strong>{{ $errors->first('category_wise_size') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('size_name') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="size_name">Size <span class="colorRed"> *</span></label>
                                <div class=" jointbox">
                                    <input type="text" class="form-control" id="size_name" name="size_name" placeholder="Name" value="@if($size->size_name) {{$size->size_name}} @else {{old('size_name')}} @endif"/>
                                    @if ($errors->has('size_name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('size_name') }}</strong>
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
    <!-- Main content -->
    <!-- /.content -->
</div>
@endsection
@section('css')
<style>
    .alert{
        padding: 6px !important;
    }
    .actStatus{
        cursor: pointer;
    }
</style>
@endsection
@section('script')

@if(Session::has('message'))
    <script>
        $(function() {
        toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
    </script>
@endif

@if(Session::has('errors'))
    <script>
        $(function() {
        $('#myModal').modal('show');
        });
    </script>
@endif

<script>
$("#cancelBtn").click(function () {
    window.location.href = "{{url('admin/size')}}";
});
    $(document).ajaxStart(function() { Pace.restart(); });

    var SITE_URL = "<?php echo URL::to('/'); ?>";

    $(document.body).on('click', "#submitBtn", function(){
        if ($("#dataForm").length){
            $("#dataForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                      "size_name":{
                          required:true,
                      },
                  },
                  messages: {
                      "size_name":{
                          required:"Please enter Size Name.",
                      },
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element.closest(".form-control"));
                    },
            });
        }
    });

    
</script>
@endsection
