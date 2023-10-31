@section('title')
Product Detail |
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/lightbox2-master/dist/css/lightbox.css')}}">
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove
{
    color: #000 !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice
{
    color: #000;
}
.select2-container--default .select2-search--inline .select2-search__field
{
    padding: 2px 8px !important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple
{
    border: solid #d2d6de 1px !important;
}
.select2-container--default .select2-selection--multiple
{
    border-radius: 0px !important;
}
</style>
@endsection

@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Update Product</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Update Product</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{route('product.update',$product->product_id)}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product Detail</h3>
                        </div>
                        <div class="box-body">
                            <input type="hidden" id="id" name="id" value="{{$product->product_id}}"/>

                            <div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_name">Product Name <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="product_name" name="product_name" class="form-control" value="@if(!empty(old('product_name'))){{old('product_name')}}@else{{$product->product_name}}@endif" placeholder="Type product_name here">
                                    @if ($errors->has('product_name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="category">Category <span class="colorRed"> *</span></label>
                                    <div class="">
                                      <?php
                                        $chkk = explode(',', $product->category_id);
                                      ?>
                                    <select name="category" class="form-control" id="category">
                                      <option></option>
                                      @foreach($category as $value)
                                      <option value="{{ $value->category_id }}" @if(in_array($value->category_id, $chkk)) selected @endif>{{ $value->name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                            </div>

                            <div class="form-group {{ $errors->has('sub_category') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="sub_category">Sub Category</label>
                                    <div class="">
                                      <?php
                                        $chkkk = explode(',', $product->sub_category_id);
                                    ?>

                                    <select name="sub_category[]" class="form-control" id="sub_category" multiple>
                                      <option></option>
                                      @foreach($subCategory as $value)
                                      <option value="{{ $value['sub_category_id'] }}" @if(in_array($value['sub_category_id'], $chkkk)) selected @endif>{{ $value['name'] }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('sub_category'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('sub_category') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                            </div>

                                <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="color">Color</label>
                                    <div class="">
                                      <?php
                                $chkk = explode(',', $product->color_id);
                                ?>
                                    <select onChange="hideShowAddNew();" name="color[]" class="form-control" id="color" multiple>
                                      <option></option>
                                      @foreach($color as $value)
                                      <option value="{{ $value->color_id }}" @if(in_array($value->color_id, $chkk)) selected @endif>{{ $value->color_name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('color'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
                                    <label  class="control-label" for="size">Size</label>
                                    <div class="">
                                      <?php
$chkk = explode(',', $product->size_id);
?>
                                    <select onChange="hideShowAddNew();" name="size[]" class="form-control" id="size" multiple>
                                      <option></option>
                                      @foreach($size as $value)
                                      <option value="{{ $value->size_id }}" @if(in_array($value->size_id, $chkk)) selected @endif>{{ $value->size_name }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('size'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                                </div>

                            <div class="form-group {{ $errors->has('customer_product_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="customer_product_price">Customer Product Price <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="customer_product_price" name="customer_product_price" class="form-control" value="@if(!empty(old('customer_product_price'))){{old('customer_product_price')}}@else{{$product->customer_product_price}}@endif" placeholder="Type customer_product_price here">
                                    @if ($errors->has('customer_product_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('customer_product_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('reseller_product_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="reseller_product_price">Reseller Product Price </label>
                                <div class="">
                                    <input maxlength="100" type="text" id="reseller_product_price" name="reseller_product_price" class="form-control" value="@if(!empty(old('reseller_product_price'))){{old('reseller_product_price')}}@else{{$product->reseller_product_price}}@endif" placeholder="Type reseller_product_price here">
                                    @if ($errors->has('reseller_product_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('reseller_product_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('offer_customer_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="offer_customer_price">Offer Customer Price </label>
                                <div class="">
                                    <input maxlength="100" type="text" id="offer_customer_price" name="offer_customer_price" class="form-control" value="@if(!empty(old('offer_customer_price'))){{old('offer_customer_price')}}@else{{$product->offer_customer_price}}@endif" placeholder="Type offer_customer_price here">
                                    @if ($errors->has('offer_customer_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('offer_customer_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('offer_reseller_price') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="offer_reseller_price">Offer Reseller Price </label>
                                <div class="">
                                    <input maxlength="100" type="text" id="offer_reseller_price" name="offer_reseller_price" class="form-control" value="@if(!empty(old('offer_reseller_price'))){{old('offer_reseller_price')}}@else{{$product->offer_reseller_price}}@endif" placeholder="Type offer_reseller_price here">
                                    @if ($errors->has('offer_reseller_price'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('offer_reseller_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('quantity_in_stock') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="quantity_in_stock">Quantity In Stock</label>
                                <div class="">
                                    <input maxlength="100" type="text" id="quantity_in_stock" name="quantity_in_stock" class="form-control" value="@if(!empty(old('quantity_in_stock'))){{old('quantity_in_stock')}}@else{{$product->quantity_in_stock}}@endif" placeholder="Type quantity_in_stock here">
                                    @if ($errors->has('quantity_in_stock'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('quantity_in_stock') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('product_short_description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_short_description"> Short Description </label>
                                <div class="">
                                    <textarea id="product_short_description" name="product_short_description" class="form-control" value="{{old('product_short_description')}}" placeholder=" Description">{{$product->product_short_description}}</textarea>
                                    @if ($errors->has('product_short_description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_short_description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('product_long_description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_long_description"> Long Description </label>
                                <div class="">
                                    <!-- <textarea id="product_long_description" name="product_long_description" class="form-control" value="{{old('product_long_description')}}" placeholder=" Description">{{$product->product_long_description}}</textarea> -->

                                    <textarea id="product_long_description" name="product_long_description">@if(isset($product)) @if(!empty(old('product_long_description'))){{old('product_long_description')}}@else{{$product->product_long_description}}@endif @endif</textarea>

                                    @if ($errors->has('product_long_description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_long_description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>


                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label  class="col-sm-4 control-label" for="image">Product Image</label><span class="colorRed">*</span>
                            <div class="col-sm-8">
                            <?php
                            $array = $product->product_image;
                            ?>

                        @foreach($array as $key => $images)
                         <div class="col-lg-2" style="margin-top : 20px" id="clear_image_{{ $key+1 }}">
                                <button onclick="removeSingleImage('{{$images}}','{{$product->product_id}}','{{ $key+1 }}')" type="button" class="btn btn-box-tool"><i class="fa fa-times"></i>
                                </button>
                             <img src="{{ $images }}" width="100px;"  height="100px;" >
                            </div>
                            @endforeach
                            <input type="file" class="form-control"  id="image" name="image[]" accept="image/png, image/jpeg, image/jpg" multiple>
                             @if ($errors->has('image'))
                            <span class="help-block alert alert-danger">
                            <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif

                            </div>
                            </div>

            <div class="form-group {{ $errors->has('product_video') ? ' has-error' : '' }}">
                <label  class="col-sm-4 control-label" for="product_video">Product Video</label>
                    <div class="col-sm-8">
                            <?php
                            $video = $product->product_video;
                            ?>
                        @foreach($video as $key => $videos)
                        <div class="col-lg-2" style="margin-top : 20px" id="clear_video_{{ $key+1 }}">
                            <button onclick="removeSingleVideo('{{$videos}}','{{$product->product_id}}','{{ $key+1 }}')" type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
                             <video width="100px;"  height="100px;" controls>
                                            <source src="{{$videos}}" type="video/mp4">
                             </video>
                        </div>
                        @endforeach
                        <input type="file" class="form-control"  id="product_video" name="product_video[]" accept="video/mp4" multiple>
                             @if ($errors->has('product_video'))
                            <span class="help-block alert alert-danger">
                            <strong>{{ $errors->first('product_video') }}</strong>
                            </span>
                            @endif

                    </div>
            </div>

                            <div class="form-group {{ $errors->has('new_arrival') ? ' has-error' : '' }}">
                                <input type="checkbox" name="new_arrival" value="1" {{ $product->new_arrival=="1"? 'checked':'' }}> New Arrival
                            </div>
                            <div class="form-group {{ $errors->has('best_sellers') ? ' has-error' : '' }}">
                                <input type="checkbox" name="best_sellers" value="1" {{ $product->best_sellers=="1"? 'checked':'' }}> Best Sellers
                            </div>
                            <div class="form-group {{ $errors->has('featured') ? ' has-error' : '' }}">
                                <input type="checkbox" name="featured" value="1" {{ $product->featured=="1"? 'checked':'' }}> Featured
                            </div>
                            <div class="form-group {{ $errors->has('special_offer') ? ' has-error' : '' }}">
                                <input type="checkbox" name="special_offer" value="1" {{ $product->special_offer=="1"? 'checked':'' }}> Special Offer
                            </div>

                            <div class="form-group {{ $errors->has('product_priority') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="product_priority">Product Priority</label>
                                <div class="">
                                    <input maxlength="100" type="text" id="product_priority" name="product_priority" class="form-control priority" value="@if(!empty(old('product_priority'))){{old('product_priority')}}@else{{$product->product_priority}}@endif" placeholder="Type product_priority here">
                                    @if ($errors->has('product_priority'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('product_priority') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                            <div class="col-sm-12">
                                <div class="" style="border-top:0">
                                    <div class="box-footer">
                                        <button type="submit" id="submitBtn" class="btn btn-info pull-right" style="margin-left: 20px;">Submit</button>
                                        <button type="button" id="cancelBtn" class="btn btn-default pull-right">Cancel</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2 pull-right" style="padding-bottom: 10px;">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal" id="addNewBtn">Add New</button>
                            </div>

                            <div id="subProduct">

                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <!-- /.col -->
        </div>
    </section>
</div>
                            <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog  " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">New Product</h4>
                                    </div>
                                    <div class="modal-body">
                                    <form class="form-horizontal" id="CategoryForm" role="form" action="" method="post" enctype="multipart/form-data" >
                                        {{ csrf_field() }}
                                        <input type="hidden" id="productID" value="{{ $product->product_id }}" name="productID">
                                        <div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
                                            <label  class="col-sm-4 control-label" for="product_name">Product Name <span class="colorRed"> *</span></label>
                                            <div class="col-sm-8">
                                                <input maxlength="100" type="text" id="product_name1" name="product_name1" class="form-control" value="{{old('product_name')}}" placeholder="Product Name">
                                                @if ($errors->has('product_name'))
                                                <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('product_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        @if($product->color_id != NULL)
                                        <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
                                        <label  class="col-sm-4 control-label" for="color">Color <span class="colorRed"> *</span></label>
                                        <?php
                                        $chkk = explode(',', $product->color_id);
                                        ?>
                                        <div class="col-sm-8">
                                            <select name="color1[]" class="form-control" id="color1"  data-old="{{old('color')}}">
                                                <option></option>
                                                @foreach($color as $value)
                                                @if(in_array($value->color_id, $chkk))
                                                <option value="{{ $value->color_id }}">{{ $value->color_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                                @if ($errors->has('color'))
                                                <span class="help-block alert alert-danger">
                                                <strong>{{ $errors->first('color') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                        </div>
                                        @endif

                                        @if($product->size_id != NULL)
                                        <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }}">
                                            <label  class="col-sm-4 control-label" for="size">Size <span class="colorRed"> *</span></label>
                                            <?php
                                            $chkk = explode(',', $product->size_id);
                                            ?>
                                            <div class="col-sm-8">
                                                <select name="size1[]" class="form-control" id="size1"  data-old="{{old('size')}}">
                                                <option></option>
                                                    @foreach($size as $value)
                                                    @if(in_array($value->size_id, $chkk))
                                                    <option value="{{ $value->size_id }}">{{ $value->size_name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                    @if ($errors->has('size'))
                                                    <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('size') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group {{ $errors->has('customer_product_price') ? ' has-error' : '' }}">
                                            <label  class="col-sm-4 control-label" for="customer_product_price">Customer Product Price <span class="colorRed"> *</span></label>
                                            <div class="col-sm-8">
                                                <input maxlength="100" type="text" id="customer_product_price1" name="customer_product_price1" class="form-control" value="{{old('customer_product_price')}}" placeholder="Customer Product Price">
                                                @if ($errors->has('customer_product_price'))
                                                <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('customer_product_price') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('offer_customer_price') ? ' has-error' : '' }}">
                                            <label  class="col-sm-4 control-label" for="offer_customer_price">Offer Customer Price <span class="colorRed"> *</span></label>
                                            <div class="col-sm-8">
                                                <input maxlength="100" type="text" id="offer_customer_price1" name="offer_customer_price1" class="form-control" value="{{old('offer_customer_price')}}" placeholder="Offer Customer Price">
                                                @if ($errors->has('offer_customer_price'))
                                                <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('offer_customer_price') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('reseller_product_price') ? ' has-error' : '' }}">
                                            <label  class="col-sm-4 control-label" for="reseller_product_price">Reseller Product Price <span class="colorRed"> *</span></label>
                                            <div class="col-sm-8">
                                                <input maxlength="100" type="text" id="reseller_product_price1" name="reseller_product_price1" class="form-control" value="{{old('reseller_product_price')}}" placeholder="Reseller Product Price">
                                                @if ($errors->has('reseller_product_price'))
                                                <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('reseller_product_price') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('offer_reseller_price') ? ' has-error' : '' }}">
                                            <label  class="col-sm-4 control-label" for="offer_reseller_price">Offer Reseller Price <span class="colorRed"> *</span></label>
                                            <div class="col-sm-8">
                                                <input maxlength="100" type="text" id="offer_reseller_price1" name="offer_reseller_price1" class="form-control" value="{{old('offer_reseller_price')}}" placeholder="Offer Reseller Price">
                                                @if ($errors->has('offer_reseller_price'))
                                                <span class="help-block alert alert-danger">
                                                    <strong>{{ $errors->first('offer_reseller_price') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" id="createBtn" class="btn btn-info pull-right">Create</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
@endsection
@section('css')

<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/prism.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/sweetalert.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/custom/image_cropping/croppie.css')}}">
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/lightbox2-master/dist/css/lightbox.css')}}">
<style>
   .profile_image_showInput {
        opacity: 1;
        cursor: pointer;
        display: block;
        margin-top: 15px;
        height: 30px;
        width: 100% !important;
        background-color: #269abc;
    }
    .changeImage {
        background: #269abc none repeat scroll 0 0;
        border-radius: 0px;
        pointer-events: none;
        display: block;
        padding: 5px 15px;
        bottom: 0;
        color: #fff;
        margin-top: -30px !important;
        margin: 0 auto;
        width: 100%;
        float: left;
        left: 0;
        position: relative;
        text-align: center;
    }
     #upload-demo{
        height: 500px;
    }
    .old_profile_imageSub, #item-img-output{
        max-width: 25% !important;
    }
    .control-label{
      display: inline-block;
    }
</style>
@endsection
@section('script')
    <script src="{{URL::asset('resources/assets/admin/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/prism.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/sweetalert.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/croppie.js')}}"></script>
    <script src="{{URL::asset('/resources/assets/custom/image_cropping/main.js')}}"></script>
    <!-- <script src="{{URL::asset('/resources/assets/custom/image_cropping/exif.js')}}"></script> -->
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    @if(Session::has('message'))
        <script>
        $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
        });
        </script>
    @endif
<script>
$(document).ajaxStart(function() { Pace.restart(); });
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var pro_id = {!! $product->product_id  !!};
var SITE_URL = "<?php echo URL::to('/'); ?>";
$.validator.addMethod("lessthan", function(value, element) {
        var customer_product_price = $("#customer_product_price").val();
        if(customer_product_price) {
            customer_product_price = parseInt(customer_product_price);
        }
        if(value) {
            value = parseInt(value);
        }
        if(value && customer_product_price && (value > customer_product_price)) {
         return false;
        }
        return true;
    }, "offer price should be less than real price.");

    $.validator.addMethod("lessthan1", function(value1, element1) {
        var reseller_product_price = $("#reseller_product_price").val();
        if(reseller_product_price) {
            reseller_product_price = parseInt(reseller_product_price);
        }
        if(value1) {
            value1 = parseInt(value1);
        }
        if(value1 && reseller_product_price && (value1 > reseller_product_price)) {
         return false;
        }
        return true;
    }, "offer price should be less than real price.");

    $(document.body).on('click', "#submitBtn", function(){
        if ($("#dataForm").length){
            $("#dataForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                        // "product_name":{
                        //   required : true
                        // },
                        // "category":{
                        //   required : true
                        // },
                        // "customer_product_price":{
                        //   required : true
                        // },
                        // "image[]":{
                        // //   required : true,
                        // //   extension: "jpg|jpeg|png|ico|bmp"
                        // },
                        // "video[]":{
                        //   extension: "mp4"
                        // },
                        "offer_customer_price":{
                          lessthan : true,
                      },
                      "offer_reseller_price":{
                          lessthan : true,
                      },

                  },
                  messages: {

                    },
                    errorPlacement: function(error, element) {
                        if(element.is('select')){
                            error.appendTo(element.closest("div"));
                        }else{
                            error.insertAfter(element.closest(".form-control"));
                        }
                    },
            });
        }
    });

    $(document).ready(function () {
        $(".priority").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
$("#cancelBtn").click(function () {
    window.location.href = "{{route('product.index')}}";
});
</script>
<script type="text/javascript">
    // Start upload preview image
    var FLIP = 2;
    var NORMAL = 1;
    var orientation = NORMAL;
    var $uploadCrop1, tempFilename, rawImg, imageId;
    var fileTypes = ['jpg', 'jpeg', 'png'];
        function readFile(input) {
            if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    var file = input.files[0]; // Get your file here
                    var fileExt = file.type.split('/')[1]; // Get the file extension
                    if (fileTypes.indexOf(fileExt) !== -1) {
                        reader.onload = function (e) {
                            // $('.upload-demo').addClass('ready');
                            // $('#cropImagePop').modal('show');
                            rawImg = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);

                    }else{
                        swal("Only JPEG, PNG, JPG file types are supported");
                        $(".item-img").val("");
                    }
                }
                else {
                swal("Please select an image");
                $("#main_image").val("");
                $("#item-img-output").attr("src",SITE_URL + "/resources/assets/img/default.png");

            }
        }

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#item-img-output').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

    $(document).ready(function() {
        // var product_id = $('#product_id').val();
        getSubProducts(pro_id);
        hideShowAddNew();
      $("#category").select2({
          placeholder: "Select Category",
          allowClear: true,
      });
    });
    $(document).ready(function() {
      $("#sub_category").select2({
          placeholder: "Select Sub Category",
          allowClear: true,
      });
    });
    $(document).ready(function() {
      $("#color").select2({
          placeholder: "Select Color",
          allowClear: true,
      });
    });
    $(document).ready(function() {

      $("#size").select2({
          placeholder: "Select Size",
          allowClear: true,
      });
    });
    $('#category').on('change', function(){
        // alert(123);
        var id = $('#category').val();

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getSubCategory',
            data: {
                id
            },
            success: function(data) {
                $('#sub_category').html(data);
            }
        });
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getcolor',
            data: {
                id
            },
            success: function(data) {
                $('#color').html(data);
            }
        });
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: SITE_URL+'/getsize',
            data: {
                id
            },
            success: function(data) {
                $('#size').html(data);
            }
        });
        });

    function removeSingleImage(images,product_id,number){
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        data:{ images: images, product_id: product_id },
                        url:  SITE_URL + '/admin/product/deleteImage',
                        success: function (data) {
                            if(data== true){
                                toastr.warning('Image Deleted !!');
                                $('#clear_image_'+number).html('');
                            }else {
                                toastr.error(data);
                            }
                        }
                    });
                }
            }
        })
    }

    function removeSingleVideo(videos,product_id,number){
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        data:{ videos: videos, product_id: product_id },
                        url:  SITE_URL + '/admin/product/deleteVideo',
                        success: function (data) {
                            if(data== true){
                                toastr.warning('Video Deleted !!');
                                $('#clear_video_'+number).html('');
                            }else {
                                toastr.error(data);
                            }
                        }
                    });
                }
            }
        })
    }

$(document).ready(function () {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function (e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i];
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
          var file = e.target;
          $(
            '<span class="pip">' +
              '<img class="imageThumb" src="' +
              e.target.result +
              '" title="' +
              file.name +
              '"/>' +
              '<br/><span class="remove">Remove image</span>' +
              "</span>"
          ).insertAfter("#files");
          $(".remove").click(function () {
            $(this).parent(".pip").remove();
          });

          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
        };
        fileReader.readAsDataURL(f);
      }
      console.log(files);
    });
  } else {
    alert("Your browser doesn't support to File API");
  }
});

$(function () {
        CKEDITOR.replace('product_long_description');
    });

$(document).ready(function() {
   $('#createBtn').on('click', function(e) {
    e.preventDefault();
     var product_name = $('#product_name1').val();
    // alert(1);
     var productID = $('#productID').val();
     var customer_product_price = $('#customer_product_price1').val();
     var reseller_product_price = $('#reseller_product_price1').val();
     var color = $('#color1').val();
     var size = $('#size1').val();
     var offer_customer_price = $('#offer_customer_price1').val();
     var offer_reseller_price = $('#offer_reseller_price1').val();
     var quantity_in_stock = $('#quantity_in_stock1').val();
     if(product_name!="" && customer_product_price!=""){
       /*  $("#butsave").attr("disabled", "disabled"); */
    //    $.ajaxSetup({
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     }
    //                 });
         $.ajax({
             type: "POST",
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('storeMultiple')}}",
             data: {
                 product_name: product_name,
                 productID: productID,
                 customer_product_price: customer_product_price,
                 reseller_product_price: reseller_product_price,
                 color:color,
                 size:size,
                 offer_customer_price:offer_customer_price,
                 offer_reseller_price:offer_reseller_price,
                 quantity_in_stock:quantity_in_stock
             },

             success: function(data){
                 console.log(data);
                 var data = JSON.parse(data);
                 if(data==true){
                //    window.location = "/userData";
                toastr.success('Product Added !!');
                $('#myModal').modal('hide');
                getSubProducts();
                 }
                 else {
                    alert("Error occured !");
                 }

             }
         });
     }
     else{
         alert('Please fill all the field !');
     }
 });
});


    function getSubProducts(){
        // var product_id = $('#product_id').val();
        // alert(product_id);
                    $.ajax({
                        type: "POST",
                        data:{pro_id: pro_id },
                        url:  SITE_URL  + '/admin/product/getSubProductDeatils',
                        success: function (data) {

                                $('#subProduct').html('');
                                $('#subProduct').html(data);

                        }
                    });
    }

    function hideShowAddNew()
    {
        var color = $('#color').val();
        var size = $('#size').val();
        console.log(color.length);
        if(color.length > 1 || size.length > 1){
            $('#addNewBtn').show();
            $('#subProduct').show();
        }else{
            $('#addNewBtn').hide();
            $('#subProduct').hide();
        }
    }

</script>
@endsection
