@section('title')
Send Notification |
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/lightbox2-master/dist/css/lightbox.css')}}">
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Send Notification</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Send Notification</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{route('notification.store')}}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Notification</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
                                <label  class="control-label" for="name">Select User <span class="colorRed"> *</span></label>
                                <div>
                                    <select class="form-control selectpicker" multiple="multiple" name="user_id[]" id="user_id" data-live-search="true">
                                        <option value="" disable>Select User</option>
                                        <option value="all">ALL</option>
                                        @foreach($users as $record)
                                            <option value="{{$record->id}}">{{$record->first_name}} {{$record->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label  class="control-label" for="title">Title <span class="colorRed"> *</span></label>
                                <div class="">
                                  <input class="form-control" type="text" id="title" name="title" placeholder="Title" />
                                    @if ($errors->has('title'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                                <label  class="control-label" for="message">Message <span class="colorRed"> *</span></label>
                                <div class="">
                                  <textarea class="form-control" id="message" name="message" placeholder="Message">{{old('message')}}</textarea>
                                    @if ($errors->has('message'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="box" style="border-top:0">
                            <div class="box-footer">
                                <button type="submit" id="createBtn" class="btn btn-info pull-right" style="margin-left: 20px;">Submit</button>
                                <button type="button" id="cancelBtn" class="btn btn-default pull-right">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.col -->
        </div>

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
    @if(Session::has('message'))
        <script>
        $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
        </script>
    @endif

    <script>

        $("#cancelBtn").click(function () {
            window.location.href = "{{route('notification.index')}}";
        });
    
        $(document.body).on('click', "#createBtn", function(){
            if ($("#dataForm").length){
                $("#dataForm").validate({
                  errorElement: 'span',
                          errorClass: 'text-red',
                          ignore: [],
                          rules: {
                            "user_id[]":{
                                required:true,
                            },
                            "title":{
                                required:true,
                                minlength: 2,
                                maxlength: 100,
                            },
                            "message":{
                                required:true,
                                minlength: 2,
                                maxlength: 200,
                            }
                        },
                        messages: {
                            "user_id[]":{
                                required:"Please select user.",
                            },
                            "title":{
                                required:"Please enter title.",
                                minlength: "Please enter at least 2 characters.",
                                maxlength: "Please do not enter more than 100 characters.",
                            },
                            "message":{
                                required:"Please enter message.",
                                minlength: "Please enter at least 2 characters.",
                                maxlength: "Please do not enter more than 200 characters.",
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
