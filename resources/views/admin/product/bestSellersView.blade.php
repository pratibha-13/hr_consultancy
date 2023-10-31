@extends('admin.layouts.app')
@section('title')  Best Sellers Product Details | @endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Product Details</h1>
    <ol class="breadcrumb">
      <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('product.index')}}">Product</a> </li>
      <li class="active">Best Sellers Product Details</li>
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
                                                <td><strong>Product</strong></td>
                                                <td class="text-primary">{{$product->product_name}}</td>
                                            </tr>
                                            @php
                                            $category = Helper::category($product['category_id']);
                                            $sub_category = Helper::subCategory($product['sub_category_id']);
                                            $color = Helper::color($product['color_id']);
                                            $size = Helper::size($product['size_id']);
                                            @endphp
                                            <tr>
                                                <td><strong>Category</strong></td>
                                                <td class="text-primary">{{$category}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sub Category</strong></td>
                                                <td class="text-primary">{{$sub_category}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Color</strong></td>
                                                <td class="text-primary">{{$color}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Size</strong></td>
                                                <td class="text-primary">{{$size}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Short Description</strong></td>
                                                <td class="text-primary">{{$product->product_short_description}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Long Description</strong></td>
                                                <td class="text-primary">{{$product->product_long_description}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Customer Product Price</strong></td>
                                                <td class="text-primary">{{$product->customer_product_price}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Customer Offer Price</strong></td>
                                                <td class="text-primary">{{$product->offer_customer_price}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Reseller Product Price</strong></td>
                                                <td class="text-primary">{{$product->reseller_product_price}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Reseller Offer Price</strong></td>
                                                <td class="text-primary">{{$product->offer_reseller_price}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Quantity in stock</strong></td>
                                                <td class="text-primary">{{$product->quantity_in_stock}}</td>
                                            </tr>


                                            @if($product->best_sellers=="1")
                                            <tr>
                                            <td><strong>Best Sellers</strong></td>
                                            <td class="text-primary">
                                            <input type="checkbox" name="best_sellers" value="1" {{ $product->best_sellers=="1"? 'checked':'' }}></td>
                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label  class="col-sm-2 control-label" for="image">Product Image</label>
                                            <div class="col-sm-10">

                                                <?php
                                                    $array = $product->product_image;
                                                ?>
                                                @foreach($array as $images)
                                            <div class="col-lg-2" style="margin-top : 20px">
                                            <img src="{{ $images }}" width="100px;"  height="100px;" >
                                            </div>
                                            @endforeach
                                            </div>
                                    </div>
                                    @if($product->product_video!=null)
                                    <div class="form-group {{ $errors->has('product_video') ? ' has-error' : '' }}">
                                            <label  class="col-sm-2 control-label" for="product_video">Product Video</label>
                                            <div class="col-sm-10">

                                                <?php
                                                $video = $product->product_video;
                                                ?>
                                            @foreach($video as $videos)
                                            <div class="col-lg-2" style="margin-top : 20px">
                                                <video width="100px;"  height="100px;" controls>
                                                    <source src="{{$videos}}" type="video/mp4">
                                                </video>
                                            </div>
                                            @endforeach
                                            </div>
                                    </div>
                                    @endif
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
                        <a type="button" href="{{route('bestSellersProduct.index')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
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
