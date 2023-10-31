@extends('admin.layouts.app')
@section('title')  Coupon Details | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Coupon Details</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('coupon.index')}}">Coupon</a> </li>
      <li class="active">Coupon Details</li>
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
                                                <td><strong>Coupon</strong></td>
                                                <td class="text-primary">{{$coupon->name}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Code</strong></td>
                                                <td class="text-primary">{{$coupon->code}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Limit</strong></td>
                                                <td class="text-primary">{{$coupon->limit}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Used Limit</strong></td>
                                                <td class="text-primary">{{$coupon->used_limit}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Type</strong></td>
                                                <td class="text-primary">{{$coupon->type}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Value</strong></td>
                                                <td class="text-primary">{{$coupon->value}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Description</strong></td>
                                                <td class="text-primary">{{$coupon->description}}</td>
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
                        <a type="button" href="{{route('coupon.index')}}" id="cancelBtn button1" class="btn btn-default pull-right">Back</a>
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
