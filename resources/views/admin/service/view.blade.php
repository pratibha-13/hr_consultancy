@extends('admin.layouts.app')
@section('title')  Service | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Service</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Service</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <!-- Horizontal Form -->
        <div class="box ">
          <!-- /.box-header -->
          <div class="col-sm-12">
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal">
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td><strong>Title</strong></td>
                                                <td class="text-primary">{{$record->title}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Description</strong></td>
                                                <td class="text-primary">{!! html_entity_decode($record->description)!!}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Description</strong></td>
                                                <td class="text-primary">{{$record->icon}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="" style="border-top:0">
                    <div class="box-footer">
                        <a type="button" href="{{route('service.index')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </section>
    </div>
  @endsection
