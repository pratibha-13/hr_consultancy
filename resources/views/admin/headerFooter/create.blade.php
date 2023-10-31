@extends('admin.layouts.app')

@section('title') Create HeaderFooter | @endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Create</h1>

        <ol class="breadcrumb">

            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Create</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-sm-12">

                <!-- Horizontal Form -->

                <div class="box">

                    <!-- /.box-header -->

                    <!-- form start -->

                    <form class="form-horizontal" id="userForm" role="form" action="{{url('admin/header_footer')}}" method="post" enctype="multipart/form-data" >

                        <div class="col-sm-8">

                            @csrf

                            <div class="box-body">

                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="address">Address <span class="colorRed"> *</span></label>

                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" id="address" name="address" placeholder="address" value="{{old('address')}}"/>

                                        @if ($errors->has('address'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('address') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('contact_number') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="contact_number">Contact Number <span class="colorRed"> *</span></label>

                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="contact_number" value="{{old('contact_number')}}"/>

                                        @if ($errors->has('contact_number'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('contact_number') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="email">Email <span class="colorRed"> *</span></label>

                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}"/>

                                        @if ($errors->has('email'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('email') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>


                                <div class="form-group {{ $errors->has('facebook_link') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="facebook_link">Facebook</label>

                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" id="facebook_link" name="facebook_link" placeholder="facebook_link" value="{{old('facebook_link')}}"/>

                                        @if ($errors->has('facebook_link'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('facebook_link') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>



                                <div class="form-group {{ $errors->has('google_link') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="google_link">Google</label>

                                    <div class="col-sm-8">

                                        <input class="form-control" id="google_link" name="google_link" placeholder="Google" value="{{old('google_link')}}"/>

                                        @if ($errors->has('google_link'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('google_link') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>



                                <div class="form-group {{ $errors->has('twitter_link') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="twitter_link">Twitter</label>

                                    <div class="col-sm-8">

                                        <input  type="text" class="form-control" id="twitter_link" name="twitter_link" placeholder="twitter_link" value="{{old('twitter_link')}}"/>

                                        @if ($errors->has('twitter_link'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('twitter_link') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('instagram_link') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="instagram_link">Instagram</label>

                                    <div class="col-sm-8">

                                        <input  type="text" class="form-control" id="instagram_link" name="instagram_link" placeholder="instagram_link" value="{{old('instagram_link')}}"/>

                                        @if ($errors->has('instagram_link'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('instagram_link') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('footer_description') ? ' has-error' : '' }}">

                                    <label  class="col-sm-4 control-label" for="footer_description">Footer Description <span class="colorRed"> *</span></label>

                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" id="footer_description" name="footer_description" placeholder="Footer Description" value="{{old('footer_description')}}"/>

                                        @if ($errors->has('footer_description'))

                                        <span class="help-block alert alert-danger">

                                            <strong>{{ $errors->first('footer_description') }}</strong>

                                        </span>

                                        @endif

                                    </div>

                                </div>



                                <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>

                                    <button type="button" class="btn btn-default"  id="cancelBtn">Close</button>

                                    <button type="submit" id="createBtn" class="btn btn-info pull-right">Create</button>

                            </div>

                            <!-- /.box-body -->

                        </div>
                    </form>

                    <div class="clearfix"></div>

                </div>

                <!-- /.box -->

            </div>

            <!-- /.col -->

        </div>

        <!-- /.row -->

    </section>

    <!-- /.content -->

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

<script>

$(document).ajaxStart(function() { Pace.restart(); });

 $.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});



var SITE_URL = "<?php echo URL::to('/header_footer'); ?>";



    $(document.body).on('click', "#createBtn", function(){

        if ($("#userForm").length){

            $("#userForm").validate({

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


$("#cancelBtn").click(function () {

    window.location.href = "{{url('admin/header_footer')}}";

});

</script>

@endsection
