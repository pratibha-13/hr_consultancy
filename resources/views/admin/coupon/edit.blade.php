@section('title')
Coupon Detail |
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
        <h1>Update Coupon</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Update Coupon</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form class="" id="dataForm" role="form" action="{{route('coupon.update',$coupon->coupon_id)}}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Coupon Detail</h3>
                        </div>
                        <div class="box-body">
                            <input type="hidden" id="id" name="id" value="{{$coupon->coupon_id}}"/>

                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="name">Coupon Name <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input maxlength="100" type="text" id="name" name="name" class="form-control" value="@if(!empty(old('name'))){{old('name')}}@else{{$coupon->name}}@endif" placeholder="Type name here">
                                    @if ($errors->has('name'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="code">Code <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input  type="text" id="code" name="code" class="form-control" value="@if(!empty(old('code'))){{old('code')}}@else{{$coupon->code}}@endif" placeholder="Type code here">
                                    @if ($errors->has('code'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('limit') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="limit">Limit <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input  type="text" id="limit" name="limit" class="form-control" value="@if(!empty(old('limit'))){{old('limit')}}@else{{$coupon->limit}}@endif" placeholder="Type limit here">
                                    @if ($errors->has('limit'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('limit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('used_limit') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="used_limit">Used Limit</label>
                                <div class="">
                                    <input type="text" id="used_limit" name="used_limit" class="form-control" value="@if(!empty(old('used_limit'))){{old('used_limit')}}@else{{$coupon->used_limit}}@endif" placeholder="Used Limit" readonly>
                                    @if ($errors->has('used_limit'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('used_limit') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="type">Type <span class="colorRed"> *</span></label>
                                <div class="">
                                <input class="form-check-input" type="radio" name="type"  value="percentage" {{ $coupon->type == 'percentage' ? 'checked':'' }}>Percentage
                                </br>
                                <input class="form-check-input" type="radio" name="type"  value="flat" {{ $coupon->type == 'flat' ? 'checked':'' }}>Flat
                                    @if ($errors->has('type'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('value') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="value">Value <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input  type="text" id="value" name="value" class="form-control" value="@if(!empty(old('value'))){{old('value')}}@else{{$coupon->value}}@endif" placeholder="Type value here">
                                    @if ($errors->has('value'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="description">Description </label>
                                <div class="">
                                    <textarea id="description" name="description" class="form-control" value="{{old('description')}}" placeholder="Description">{{$coupon->description}}</textarea>
                                    @if ($errors->has('description'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                            </div>

                            <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="start_date">Start Date <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input  type="date" id="start_date" name="start_date" class="form-control" value="@if(!empty(old('start_date'))){{old('start_date')}}@else{{$coupon->start_date}}@endif" placeholder="Type start_date here">
                                    @if ($errors->has('start_date'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label  class=" control-label" for="end_date">End Date <span class="colorRed"> *</span></label>
                                <div class="">
                                    <input  type="date" id="end_date" name="end_date" class="form-control" value="@if(!empty(old('end_date'))){{old('end_date')}}@else{{$coupon->end_date}}@endif" placeholder="Type end_date here">
                                    @if ($errors->has('end_date'))
                                    <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('end_date') }}</strong>
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
                        </div>
                    </div>
                </div>

            </form>
            <!-- /.col -->
        </div>
    </section>
</div>
@endsection
@section('script')
    <script src="{{URL::asset('resources/assets/admin/plugins/ckeditor/ckeditor.js')}}"></script>
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

var SITE_URL = "<?php echo URL::to('/'); ?>";

    $(document.body).on('click', "#submitBtn", function(){
        if ($("#dataForm").length){
            $("#dataForm").validate({
            errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {


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
        $("#limit").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(document).ready(function () {
        $("#value").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

$("#cancelBtn").click(function () {
    window.location.href = "{{route('coupon.index')}}";
});
</script>
@endsection
