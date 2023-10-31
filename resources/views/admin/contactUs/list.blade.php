@section('title')
    Contact Us |
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Contact Us</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('adminDashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Contact Us</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        {!! $html->table(['class' => 'table table-bordered','id'=>'datatable']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('css')
    <style>
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

@if(Session::has('errors'))
    <script>
        $(function() {
        $('#myModal').modal('show');
        });
    </script>
@endif

@endsection
