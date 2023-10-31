@extends('admin.layouts.app')
@section('title')   Details | @endsection
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Details</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/header_footer')}}"> Header Footer Settings</a> </li>
      <li class="active">Details</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <!-- Horizontal Form -->
        <div class="box ">
          <!-- /.box-header -->
          <div class="col-sm-8">
                <div class="box-body">
                    <div class="table-responsive">
                                <table class="table table-user-information">

                                    <tbody>

                                        <tr>
                                            <td><strong>Address</strong></td>
                                            <td class="text-primary">{{$user->address}}</td>
                                        </tr>
                                         <tr>
                                            <td><strong>Contact Number</strong></td>
                                            <td class="text-primary">{{$user->contact_number}}</td>
                                        </tr>
                                         <tr>
                                            <td><strong>Email</strong></td>
                                            <td class="text-primary">{{$user->email}}</td>
                                        </tr>
                                         <tr>
                                            <td><strong>Facebook</strong></td>
                                            <td class="text-primary">{{$user->facebook_link}}</td>
                                        </tr>

                                         <tr>
                                            <td><strong>Google</strong></td>
                                            <td class="text-primary">{{$user->google_link}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Twitter</strong></td>
                                            <td class="text-primary">{{$user->twitter_link}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Instagram</strong></td>
                                            <td class="text-primary">{{$user->instagram_link}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Footer Description</strong></td>
                                            <td class="text-primary">{{$user->footer_description}}</td>
                                        </tr>

                                      </tbody>
                                </table>
                            </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="" style="border-top:0">
                    <div class="box-footer">
                        <a type="button" href="{{url('/admin/header_footer')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
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
