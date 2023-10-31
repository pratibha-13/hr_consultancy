@section('title')
  Brand |
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  {{--  add new modal  --}}
  <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Brand</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="CategoryForm" role="form" action="{{url('admin/brand')}}" method="post" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('brand_name') ? ' has-error' : '' }}">
              <label  class="col-sm-4 control-label" for="brand_name">Name <span class="colorRed"> *</span></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Name" value="{{old('name')}}"/>
                @if ($errors->has('brand_name'))
                  <span class="help-block alert alert-danger">
                    <strong>{{ $errors->first('brand_name') }}</strong>
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
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Brand</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Brand</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
    
        <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
          <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">New Brand</button>
        </div>
     
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            {!! $html->table(['class' => 'table table-bordered','id'=>'brandDataTable']) !!}
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

  <script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/jquery.validate.js')}}"></script>
  <script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/additional-methods.js')}}"></script>
  {!! $html->scripts() !!}
  

<script>
  $(document).ajaxStart(function() { Pace.restart(); });
  var today = new Date();
  $('#dob').datepicker({
    format: 'dd-MM-yyyy',
    autoclose:true,
    endDate: "today",
    maxDate: today
  });
  var SITE_URL = "<?php echo URL::to('/'); ?>";

  $(document.body).on('click', "#createBtn", function(){
    if ($("#CategoryForm").length){
      $("#CategoryForm").validate({
        errorElement: 'span',
        errorClass: 'text-red',
        ignore: [],
        rules: {
          "brand_name":{
            required:true,
            minlength: 2,
            maxlength: 20
          },
        },
        messages: {
          "brand_name":{
            required:"Please enter Brand Name.",
          },
        },
        errorPlacement: function(error, element) {
          error.insertAfter(element.closest(".form-control"));
        },
      });
    }
  });
  $(document.body).on('click', '.actStatus' ,function(event){
    var row = this.id;
    var dbid = $(this).attr('data-sid');

    bootbox.confirm({
      message: "Are you sure you want to change Category status ?",
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
            url  : SITE_URL+'/admin/brand/status-change',
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

  function deleteConfirm(id){
    bootbox.confirm({
      message: "Are you sure you want to delete ?",
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
            url: SITE_URL + '/admin/brand/delete/'+id,
            success: function (data) {
              toastr.warning('Brand Deleted !!');
              $('#brandDataTable').DataTable().ajax.reload(null, false);
            }
          });
        }
      }
    })
  }
</script>
@endsection
