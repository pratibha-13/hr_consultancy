@extends('admin.layouts.app')
@section('title')  Our Team | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Our Team</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Our Team</li>
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
                                                <td><strong>Full Name</strong></td>
                                                <td class="text-primary">{{$record->full_name}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Designation</strong></td>
                                                <td class="text-primary">{{$record->designation}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Profile</strong></td>
                                                <td class="text-primary">
                                                    <figure>
                                                        <a href="@if(isset($record))@if($record->getOriginal('profile')){{$record->profile}} @endif @else {{ URL::asset('/resources/assets/img/user.png')}} @endif " target="_blank">
                                                            <img src="@if(isset($record))@if($record->getOriginal('profile')){{$record->profile}} @endif @else {{ URL::asset('/resources/assets/img/user.png')}} @endif " class="gambar old_imageSub" id="item-img-output"  name="avatar" width="300px"/>
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
                        <a type="button" href="{{route('ourTeam.index')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
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
