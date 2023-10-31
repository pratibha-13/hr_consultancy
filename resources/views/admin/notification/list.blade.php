@section('title')
Notification |
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Notification</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Notification</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @if(Auth::user()->can('notification-create')))
                <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
                    <a href="{{route('notification.create')}}"><button type="button" class="btn btn-block btn-primary">Send Notification</button></a>
                </div>
            @endif

            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! $html->table(['class' => 'table table-bordered','id'=>'DataTable']) !!}
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

</script>
@endsection
