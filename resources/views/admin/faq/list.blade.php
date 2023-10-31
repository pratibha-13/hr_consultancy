@extends('admin.layouts.app')

@section('title') Help Question  | @endsection
@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Help Question </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Help Question </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
                <a href="{{url('admin/faq/create')}}" class="btn btn-block btn-primary">New Question</a>
            </div>

            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! $html->table(['class' => 'table table-bordered','id'=>'FAQDataTable']) !!}
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
@section('script')

<script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/jquery.validate.js')}}"></script>
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

  function deleteConfirm(id){
    bootbox.confirm({
      message: "Are you sure you want to delete ?",
      buttons: {'cancel': {label: 'No',className: 'btn-danger'},
        'confirm': {label: 'Yes',className: 'btn-success'}
      },
      callback: function(result){
        if (result){
          $.ajax({            
            url: SITE_URL + '/admin/faq/'+id,
            type: "DELETE",
            cache: false,
            data:{ _token:'{{ csrf_token() }}'},
            success: function (data, textStatus, xhr) {
              if(data== true && textStatus=='success' && xhr.status=='200')
              {
                  toastr.warning('Question Deleted !!');
                  $('#FAQDataTable').DataTable().ajax.reload(null, false);
              }
              else {  toastr.error(data); }
            }
          });
        }
      }
    });
  }
</script>
@endsection
