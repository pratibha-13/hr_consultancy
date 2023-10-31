@extends('admin.layouts.app')

@section('title')
City |
@endsection

@section('content')
    <div class="content-wrapper">

        {{--  add new modal  --}}
        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog  " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">New City</h4>
                    </div>

                    <div class="modal-body">
                        <form class="form-horizontal" id="userForm" role="form" action="{{url('admin/city/new')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="city_state" value="{{$state->state_id}}">
                            <div class="form-group {{ $errors->has('city_name') ? ' has-error' : '' }}">
                                <label  class="col-sm-4 control-label" for="city_name">State Name <span class="colorRed"> *</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="city_name" name="city_name" placeholder="State Name" value="{{old('city_name')}}"/>
                                    @if ($errors->has('city_name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('city_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="createBtn" class="btn btn-info pull-right">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--  <!-- Content Header (Page header) -->  --}}
        <section class="content-header">
            <h1>City</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/state/view').'/'.$state->country_id}}"><i class="fa fa-dashboard"></i> State</a></li>
                <li class="active">City</li>
            </ol>
        </section>

        {{--  <!-- Main content -->  --}}
        <section class="content">
            <div class="row">

                <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">New City</button>
                </div>

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
                {{--  <!-- /.col -->  --}}
            </div>
            {{--  <!-- /.row -->  --}}
        </section>
        {{--  <!-- /.content -->  --}}
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

    @if(Session::has('message'))
        <script>
            $(function() {
                toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
            });
        </script>
    @endif

    <script>
        var SITE_URL = "<?php echo URL::to('/'); ?>";
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
                url  : SITE_URL+'/admin/city/status-change',
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
      
        $('#country').on('change', function() {
            var country_id = $('#country').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type :'POST',
                data : {
                    id:country_id
                },
                url  : SITE_URL+'/getState',
                success  : function(response) {
                    $('#state').html(response);
                }
            });
        });

        $(document.body).on('click', "#createBtn", function(){
            if ($("#userForm").length){
                $("#userForm").validate({
                    errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                        "city_name":{
                            required:true,
                            minlength: 2,
                            maxlength: 20
                        }
                    },
                    messages: {
                        "city_name":{
                            required:"Enter City Name",
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

        function deleteConfirm(id){
            bootbox.confirm({
            message: "<p class='text-red'>Are you sure you want to delete ?</p>",
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
                            url: SITE_URL + '/admin/city/delete/'+id,
                            success: function (data) {
                                toastr.warning('Country Deleted !!');
                                $('#datatable').DataTable().ajax.reload(null, false);
                            }
                        });
                    }
                }
            })
        }
    </script>
@endsection
