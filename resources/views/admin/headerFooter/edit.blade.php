@extends('admin.layouts.app')
@section('title') Update | @endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Update</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{url('admin/header_footer')}}">Header Footer Settings</a></li>
            <li class="active">Update</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <!-- Horizontal Form -->
                <div class="box ">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="empForm" action="{{url('admin/header_footer').'/'.$user->id}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                    <div class="col-sm-8">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <input type="hidden" id="id" name="id" value="{{$user->id}}"/>
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="address">Address <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="address" value="@if(!empty(old('address'))){{old('address')}}@else{{$user->address}}@endif"/>
                                        @if ($errors->has('address'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('latitude') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="latitude">Latitude <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="latitude" value="@if(!empty(old('latitude'))){{old('latitude')}}@else{{$user->latitude}}@endif"/>
                                        @if ($errors->has('latitude'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('longitude') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="longitude">Longitude <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="longitude" value="@if(!empty(old('longitude'))){{old('longitude')}}@else{{$user->longitude}}@endif"/>
                                        @if ($errors->has('longitude'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('contact_number') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="contact_number">Contact Number <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="contact_number" value="@if(!empty(old('contact_number'))){{old('contact_number')}}@else{{$user->contact_number}}@endif"/>
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
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="@if(!empty(old('email'))){{old('email')}}@else{{$user->email}}@endif"/>
                                        @if ($errors->has('email'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('facebook_link') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="facebook_link">Facebook <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="facebook_link" name="facebook_link" placeholder="facebook_link" value="@if(!empty(old('facebook_link'))){{old('facebook_link')}}@else{{$user->facebook_link}}@endif"/>
                                        @if ($errors->has('facebook_link'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('facebook_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('linkedIn_link') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="linkedIn_link">LinkedIn <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="linkedIn_link" name="linkedIn_link" placeholder="linkedIn_link" value="@if(!empty(old('linkedIn_link'))){{old('linkedIn_link')}}@else{{$user->linkedIn_link}}@endif"/>
                                        @if ($errors->has('linkedIn_link'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('linkedIn_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('twitter_link') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="twitter_link">Twitter <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="twitter_link" name="twitter_link" placeholder="twitter_link" value="@if(!empty(old('twitter_link'))){{old('twitter_link')}}@else{{$user->twitter_link}}@endif"/>
                                        @if ($errors->has('twitter_link'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('twitter_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('instagram_link') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="instagram_link">Instagram <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="instagram_link" name="instagram_link" placeholder="instagram_link" value="@if(!empty(old('instagram_link'))){{old('instagram_link')}}@else{{$user->instagram_link}}@endif"/>
                                        @if ($errors->has('instagram_link'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('instagram_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('copyright') ? ' has-error' : '' }}">
                                    <label  class="col-sm-4 control-label" for="copyright">Copyright <span class="colorRed"> *</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="copyright" name="copyright" placeholder="copyright" value="@if(!empty(old('copyright'))){{old('copyright')}}@else{{$user->copyright}}@endif"/>
                                        @if ($errors->has('copyright'))
                                        <span class="help-block alert alert-danger">
                                            <strong>{{ $errors->first('copyright') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="button" class="btn btn-default" id="cancelBtn">Back</button>
                                <button type="submit" id="updateBtn" class="btn btn-info pull-right">Update</button>
                            </div>
                            <!-- /.box-footer -->

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
    $("#cancelBtn").click(function () {
        window.location.href = "{{url('admin/header_footer')}}";
    });
$(document).ajaxStart(function() { Pace.restart(); });
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(document.body).on('click', "#updateBtn", function(){
        if ($("#empForm").length){
            $("#empForm").validate({
              errorElement: 'span',
                      errorClass: 'text-red',
                      ignore: [],
                      rules: {
                      "address":{
                          required:true,
                      },
                      "latitude":{
                          required:true,
                      },
                      "longitude":{
                          required:true,
                      },
                    },
                    messages: {
                        "address":{
                            required:"Please enter address.",
                        },
                        "latitude":{
                            required:"Please enter latitude.",
                        },
                        "longitude":{
                            required:"Please enter longitude.",
                        },
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

    var SITE_URL = "<?php echo URL::to('/'); ?>";


</script>



@endsection
