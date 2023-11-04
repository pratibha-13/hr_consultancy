@section('title')
Free Quote |
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Free Quote</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Free Quote</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type :'POST',
                        data : {id:dbid},
                        url  : 'freeQuote/status-change',
                        success  : function(response) {
                            if (response == 'Active') {
                                $('#'+row+'').text('Active').removeClass('text-danger').addClass('text-green');
                            }else if(response == 'Deactive') {
                                $('#'+row+'').text('Deactive').removeClass('text-green').addClass('text-danger');
                            }else if(response == 'error') {
                                bootbox.alert('Something Went to Wrong');
                            }
                        }
                    });
                }
            }
        });
    });
</script>
@endsection
