@extends('admin.layouts.app')
@section('title')  Banner Details | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Banner Details</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('banner.index')}}"> Banner</a> </li>
      <li class="active">Banner Details</li>
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
                                                <td class="text-primary">{{$record->banner_description}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Link</strong></td>
                                                <td class="text-primary"><a href="{{$record->link}}" target="_blank">{{$record->link}}</a></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Banner</strong></td>
                                                <td class="text-primary">
                                                    <figure>
                                                        <a href="@if(isset($record))@if($record->getOriginal('image')){{$record->image}} @endif @else {{ URL::asset('/resources/assets/img/default.png')}} @endif " target="_blank">
                                                            <img src="@if(isset($record))@if($record->getOriginal('image')){{$record->image}} @endif @else {{ URL::asset('/resources/assets/img/default.png')}} @endif " class="gambar old_imageSub" id="item-img-output"  name="avatar" width="300px"/>
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
                        <a type="button" href="{{route('banner.index')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
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
