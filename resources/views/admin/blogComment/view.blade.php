@extends('admin.layouts.app')
@section('title')  Blog Comment | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Blog Comment</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Blog Comment</li>
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
                                                <td><strong>Blog</strong></td>
                                                <td class="text-primary">{{$blog->blog_title}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>User Name</strong></td>
                                                <td class="text-primary">{{$record->user_name}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td class="text-primary">{{$record->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Comment</strong></td>
                                                <td class="text-primary">{!! html_entity_decode($record->comments)!!}</td>
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
                        <a type="button" href="{{route('blogComment.index')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
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
