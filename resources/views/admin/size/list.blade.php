@section('title')
  Size |
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
          <h4 class="modal-title" id="myModalLabel">New Size</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="CategoryForm" role="form" action="{{url('admin/size')}}" method="post" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('category_wise_size') ? ' has-error' : '' }}">
                <label  class="col-sm-4 control-label" for="category_wise_size">Category <span class="colorRed"> *</span></label>
                <div class="col-sm-8">
                  <div>
                    <select name="category_wise_size" id="category_wise_size" class="form-control">
                     
                      @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  @if ($errors->has('category_wise_size'))
                    <span class="help-block alert alert-danger">
                      <strong>{{ $errors->first('category_wise_size') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            <div class="form-group {{ $errors->has('size_name') ? ' has-error' : '' }}">
              <label  class="col-sm-4 control-label" for="size_name">Size <span class="colorRed"> *</span></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="size_name" name="size_name" placeholder="Size" value="{{old('name')}}"/>
                @if ($errors->has('size_name'))
                  <span class="help-block alert alert-danger">
                    <strong>{{ $errors->first('size_name') }}</strong>
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
    <h1>Size</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Size</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
    
        <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
          <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">New Size</button>
        </div>
     
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            {!! $html->table(['class' => 'table table-bordered','id'=>'sizeDataTable']) !!}
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
          "category_wise_size":{
            required:true,
          },
          "size_name":{
            required:true,
          },
        },
        messages: {
          "category_wise_size":{
            required:"Please Select Category.",
          },
          "size_name":{
            required:"Please enter Size.",
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
      message: "Are you sure you want to change Size status ?",
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
            url  : SITE_URL+'/admin/size/status-change',
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
            url: SITE_URL + '/admin/size/delete/'+id,
            success: function (data) {
              toastr.warning('Size Deleted !!');
              $('#sizeDataTable').DataTable().ajax.reload(null, false);
            }
          });
        }
      }
    })
  }
</script>
@endsection
