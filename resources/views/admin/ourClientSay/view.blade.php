@extends('admin.layouts.app')
@section('title')  Our Client Say | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Our Client Say</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Our Client Say</li>
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
                                                <td><strong>Name</strong></td>
                                                <td class="text-primary">{{$record->our_client_say_name}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>City</strong></td>
                                                <td class="text-primary">{{$record->our_client_say_city}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Description</strong></td>
                                                <td class="text-primary">{{$record->our_client_say_description}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Image</strong></td>
                                                <td class="text-primary">
                                                    <figure>
                                                        <a href="@if(isset($record))@if($record->getOriginal('our_client_say_profile')){{$record->our_client_say_profile}} @endif @else {{ URL::asset('/resources/assets/img/default.png')}} @endif " target="_blank">
                                                            <img src="@if(isset($record))@if($record->getOriginal('our_client_say_profile')){{$record->our_client_say_profile}} @endif @else {{ URL::asset('/resources/assets/img/default.png')}} @endif " class="gambar old_imageSub" id="item-img-output"  name="avatar" width="300px"/>
                                                        </a>
                                                    </figure>     
                                                </td>
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
                        <a type="button" href="{{route('ourClientSay.index')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
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
