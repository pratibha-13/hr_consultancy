@section('title')
Testimonial |
@endsection
@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Testimonial</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Testimonial</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
                <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
                    <a href="{{route('ourClientSay.create')}}"><button type="button" class="btn btn-block btn-primary">New Our Client Say</button></a>
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
        message: "Are you sure you want to change Our Client Say status ?",
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
                        url  : 'ourClientSay/status-change',
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
                        url: SITE_URL + '/admin/ourClientSay/'+id,
                        type: "DELETE",
                        cache: false,
                        data:{ _token:'{{ csrf_token() }}'},
                        success: function (data , textStatus, xhr) {
                            if(data== true && textStatus=='success' && xhr.status=='200'){
                                toastr.warning('Our Client Say Deleted !!');
                                $('#datatable').DataTable().ajax.reload(null, false);
                            }else {
                                toastr.error(data);
                            }
                        }
                    });
                }
            }
        })
    }
</script>
@endsection
