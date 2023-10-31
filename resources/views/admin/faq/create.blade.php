@extends('admin.layouts.app') 

@section('title') {{$action}} Help Question  | @endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{$action}} Question</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{url('admin/faq')}}"> Help Question </a></li>
            <li class="active">{{$action}} Question</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <!-- Horizontal Form -->
                <div class="box ">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="col-sm-12">
                        <form class="" id="faqForm" action="{{url($url)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method($method)
                            <input type="hidden" id="faq_id" name="faq_id" value="@if(isset($faq)) {{$faq->faq_id}} @endif"/>
                            <div class="box-body">
                            <div class="form-group">
                                        <label  class=" control-label" for="type">Choose a Type:</label>
                                        <div class="">
                                           
                                        <select class="form-control" name="type" id="type">
                                        <option value="general">General</option>
                                        <option value="other">Other</option>
                                        </select>
                                        
                                        @if ($errors->has('type'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class=" control-label" for="question">Question</label>
                                    <div class="">
                                        <textarea class="form-control" id="question" name="question">@if(isset($faq)) @if(!empty(old('question'))){{old('question')}}@else{{$faq->question}}@endif @endif</textarea>
                                        @if ($errors->has('question'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('question') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label  class=" control-label" for="answer">Answer</label>
                                    <div class="">
                                        <textarea class="form-control" id="answer" name="answer">@if(isset($faq))@if(!empty(old('answer'))){{old('answer')}}@else{{$faq->answer}}@endif
                                            @endif</textarea>
                                        @if ($errors->has('answer'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('answer') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" id="faqBtn" class="btn btn-info pull-right" style="margin-left: 20px;">{{$action}}</button>
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
    </section>
    <!-- /.content -->
</div>
@endsection
@section('css')
    <style>
        textarea {
            resize: none;
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

<script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/jquery.validate.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
    $(function () {
        CKEDITOR.replace('answer');
    });
</script>
<script>
    $("#cancelBtn").click(function () {
        window.location.href = "{{url('admin/faq')}}";
    });
    $(document).ajaxStart(function() { Pace.restart(); });
    var SITE_URL = "<?php echo URL::to('/'); ?>";
    
    $(document.body).on('click', "#faqBtn", function(){
        if ($("#faqForm").length){
            $("#faqForm").validate({
            errorElement: 'span',
            errorClass: 'text-red',
            ignore: [],
            rules :{
                "question":{
                    required:true,
                    minlength: 2,
                },
                "type":{
                    required:true,
                },
                "answer":{
                    required:true,
                    minlength: 2,
                },
                
            },
            messages: {
                "question":{
                    required:"Question should not be blank",
                },
                "type":{
                    required:"Type should not be blank",
                },
                "answer":{
                    required:"Answer should not be blank",
                },
            
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                error.insertAfter(element.closest(".form-control"));
             }
            });
        }
    });
</script>
@endsection