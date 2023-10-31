@extends('admin.layouts.app')
@section('title')  Order Details | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Order Details</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('order.index')}}">Order</a> </li>
      <li class="active">Order Details</li>
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
                                                <td><strong>ID</strong></td>
                                                <td class="text-primary">{{$order->order_id}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Quantity</strong></td>
                                                <td class="text-primary">{{$order->final_quantity}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sub Total</strong></td>
                                                <td class="text-primary">{{$order->sub_total}}</td>
                                            </tr>
                                            @if($order->coupon_id)
                                            <tr>
                                                <td><strong>Coupon ID</strong></td>
                                                <td class="text-primary">{{$order->coupon_id}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Coupon Name</strong></td>
                                                <td class="text-primary">{{$coupon->name}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Value</strong></td>
                                                <td class="text-primary">{{$coupon->value}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Discount Amount</strong></td>
                                                <td class="text-primary">{{$order->discount_amount}}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td class="text-primary">{{$order->total}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Order Details:</strong></td>
                                            </tr>
                                            <table class="table" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                            @foreach ($orderDetail as $key => $product)
                                                <tr>
                                                <td>{{$product->product_name}}</td>
                                                <td><i class="fa fa-inr" aria-hidden="true"></i>{{$product->price}}</td>
                                                <td>{{$product->quantity}}</td>
                              	                <td><i class="fa fa-inr" aria-hidden="true"></i>{{$product->total}}</td>
                                                </tr>
                                            @endforeach
                                            <tbody>
                                            </table>
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                    <input type="hidden" id="order_id" name="order_id" value="{{$order->order_id}}"/>
                                        <label  class="control-label" for="status">Status</label>
                                        <div class="">
                                        <select name="status" class="form-control" id="status">
                                            <option value="Order Placed" @if($order['status']=='Order Placed') selected @endif>Order Placed</option>
                                            <option value="Accepted" @if($order['status']=='Accepted') selected @endif>Accepted</option>
                                            <option value="Processing" @if($order['status']=='Processing') selected @endif>Processing</option>
                                            <option value="Dispatched" @if($order['status']=='Dispatched') selected @endif>Dispatched</option>
                                            <option value="Delivered" @if($order['status']=='Delivered') selected @endif>Delivered</option>
                                        </select>
                                    </div>
                            </div>
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
                        <a type="button" href="{{route('order.index')}}" id="cancelBtn button1" class="btn btn-default pull-right">Back</a>
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
@section('script')
@if(Session::has('message'))
    <script>
        $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
    </script>
@endif
<script type="text/javascript">
var SITE_URL = "<?php echo URL::to('/'); ?>";
$(document.body).on('change', '#status',function() {
    var status = $('#status').find(":selected").val();
    var order_id = $('#order_id').val();
    $.ajax({
            type :'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {status:status,order_id:order_id},
            url: SITE_URL + '/admin/order/status-change',
            success  : function(response) {
            toastr.success('Status Updated Successfully !!');
            $('#datatable').DataTable().ajax.reload(null, false);
            }
          });
});
</script>
@endsection
