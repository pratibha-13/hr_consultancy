@extends('admin.layouts.app')

@section('title')  CMS Pages | @endsection

@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>CMS Pages</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">CMS Pages</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
        <a href="{{url('admin/pages/create')}}" class="btn btn-block btn-primary"> New Page</a>
      </div>
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            {!! $html->table(['class' => 'table table-bordered','id'=>'CMSPagesDataTable']) !!}
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
<script>
  var SITE_URL = "<?php echo URL::to('/'); ?>";

  function deleteConfirm(id){
    bootbox.confirm({
      message: "Are you sure you want to delete ?",
      buttons: {'cancel': {label: 'No',className: 'btn-danger'},
        'confirm': {label: 'Yes', className: 'btn-success'}
      },
      callback: function(result){
        if (result){
          $.ajax({            
            url: SITE_URL + '/admin/pages/'+id,
            type: "DELETE",
            cache: false,
            data:{ _token:'{{ csrf_token() }}'},
            success: function (data, textStatus, xhr) {
              if(data== true && textStatus=='success' && xhr.status=='200')
              {
                  toastr.warning('Page Deleted !!');
                  $('#CMSPagesDataTable').DataTable().ajax.reload(null, false);
              }
              else {  toastr.error(data); }
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
      message: "Are you sure you want to change Page status ?",
      buttons: {'cancel': {label: 'No',className: 'btn-danger'},
          'confirm': {label: 'Yes',className: 'btn-success'}
      },
      callback: function(result){
        if (result){
          $.ajax({
            type :'POST',
            data : {id:dbid, _token:'{{ csrf_token() }}'},
            url  : 'pages/status-change',
            success  : function(response) {
              if (response == 'Active') {
                $('#'+row+'').text('Active').removeClass('text-danger').addClass('text-green');
              }
              else if(response == 'Deactive') {
                $('#'+row+'').text('Deactive').removeClass('text-green');
                $('#'+row+'')
                $('#'+row+'')
              }
            }
          });
        }
      }
    });
  });

</script>
@endsection
