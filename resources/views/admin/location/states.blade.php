@section('title')
State |
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        {{--  add new modal for state--}}
        <div class="modal fade in" id="stateModal" role="dialog" aria-labelledby="stateModalLabel">
            <div class="modal-dialog  " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="stateModalLabel">New State</h4>
                    </div>

                    <div class="modal-body">
                        <form class="form-horizontal" id="stateForm" role="form" action="{{url('admin/state/new')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('state_country') ? ' has-error' : '' }}">
                                <label  class="col-sm-4 control-label" for="state_country">Country <span class="colorRed"> *</span></label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="state_country" value="{{$country_id}}">
                                    <select id="state_country" class="form-control" disabled>
                                        <option></option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->country_id }}" @if($country_id == $country->country_id) selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="country-error"></div>
                                    @if ($errors->has('state_country'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('state_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('state_name') ? ' has-error' : '' }}">
                                <label  class="col-sm-4 control-label" for="state_name">State Name <span class="colorRed"> *</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="state_name" name="state_name" placeholder="State Name" value="{{old('state_name')}}"/>
                                    @if ($errors->has('state_name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('state_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="stateCreateBtn" class="btn btn-info pull-right">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>State</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/countries')}}"><i class="fa fa-dashboard"></i> Country</a></li>
                <li class="active">State</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#stateModal">New State</button>
                </div>

                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="col-xs-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    {!! $html->table(['class' => 'table table-bordered','id'=>'datatable']) !!}
                                    
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.box-body -->
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
        .alert{
            padding: 6px !important;
        }
        .actStatus{
            cursor: pointer;
        }
    </style>
@endsection
@section('script')
{!! $html->scripts() !!}
<script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/jquery.validate.js')}}"></script>
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
                $('#stateModal').modal('show');
            });
        </script>
    @endif

    <script>
        var SITE_URL = "<?php echo URL::to('/'); ?>";

        function deleteConfirm(id){
            bootbox.confirm({
            message: "<p class='text-red'>Are you sure you want to delete ?</p><p class='text-red'>It will delete all the related cities.</p>",
                buttons: {
                    'cancel': {
                        label: 'No',
                        className: 'btn-danger'
                    },
                    'confirm': {
                        label: 'Yes',
                        className: 'btn-success'
                    }
                },
                callback: function(result){
                    if (result){
                        $.ajax({
                            url: SITE_URL + '/admin/state/delete/'+id,
                            success: function (data) {
                                toastr.warning('Country Deleted !!');
                                $('#datatable').DataTable().ajax.reload(null, false);
                            }
                        });
                    }
                }
            })
        }

        $(document.body).on('click', '.actStatus' ,function(event){
            var row = this.id;
            var dbid = $(this).attr('data-sid');
            bootbox.confirm({
            message: "Are you sure you want to change status ?",
            buttons: {'cancel': { label: 'No',className: 'btn-danger'},
            'confirm': { label: 'Yes',className: 'btn-success'}
            },
            callback: function(result){  
            if (result){
                $.ajax({
                type :'POST',
                data : {id:dbid, _token:'{{ csrf_token() }}'},
                url  : SITE_URL+'/admin/state/status-change',
                success  : function(response) {
                    if (response == 'Active') {
                        $('#'+row+'').text('Active').removeClass('text-danger').addClass('text-green');
                    }
                    else if(response == 'Deactive') {
                        $('#'+row+'').text('Deactive').removeClass('text-green').addClass('text-danger');
                    }
                    else if(response == 'error') {
                    bootbox.alert('Something Went to Wrong');
                    }
                }
                });
                }
            }
            });
        });

        $(document.body).on('click', "#stateCreateBtn", function(){
            if ($("#stateForm").length){
                $("#stateForm").validate({
                    errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                        "state_country":{
                            required:true,
                        },
                        "state_name":{
                            required:true,
                            minlength: 2,
                            maxlength: 20
                        }
                    },
                    messages: {
                        "state_country":{
                            required:"@lang('messages.country_state_city.country')",
                        },
                        "state_name":{
                            required:"Please enter state name",
                        }
                    },
                    errorPlacement: function(error, element) {
                        if(element.attr("name") == 'state_country'){
                            element.closest('.form-group ').find(".country-error").html(error);
                        } else {
                            error.insertAfter(element.closest(".form-control"));
                        }
                    },
                });
            }
        });

    </script>
@endsection
