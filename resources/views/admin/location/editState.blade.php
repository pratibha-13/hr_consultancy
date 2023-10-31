@section('title')
State Detail |
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('/resources/assets/admin/plugins/lightbox2-master/dist/css/lightbox.css')}}">
@endsection
@extends('admin.layouts.app') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>State Detail</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{url('admin/users')}}"> State</a></li>
            <li class="active">Detail</li>
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
                    <form class="form-horizontal" id="editCountryForm" action="{{url('admin/state/update')}}" method="post" enctype="multipart/form-data">
                    <div class="col-sm-12">
                            {{ csrf_field() }}
                            <input type="hidden" name="state_id" value="{{$state->state_id}}">
                            <div class="box-body">
                              <div class="form-group {{ $errors->has('state_country') ? ' has-error' : '' }}">
                                  <label  class=" control-label" for="state_country">Country <span class="colorRed"> *</span></label>
                                  <div class="">
                                    <select id="state_country" class="form-control" name="state_country" disabled >
                                              <option value="{{ $countries->country_id }}" selected>{{ $countries->name }}</option>
                                      </select>
                                      <div class="country-error"></div>
                                      @if ($errors->has('state_country'))
                                      <span class="help-block alert alert-danger">
                                          <strong>{{ $errors->first('state_country') }}</strong>
                                      </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group {{ $errors->has('state_name') ? ' has-error' : '' }}">
                                  <label  class=" control-label" for="state_name">State Name <span class="colorRed"> *</span></label>
                                  <div class="">
                                      <input type="text" class="form-control" id="state_name" name="state_name" placeholder="State Name" value="{{ $state->name}}"/>
                                      @if ($errors->has('state_name'))
                                      <span class="help-block alert alert-danger">
                                          <strong>{{ $errors->first('state_name') }}</strong>
                                      </span>
                                      @endif
                                  </div>
                              </div>
                            </div>
                            <span class="help-block"> <span class="colorRed"> *</span> mentioned fields are mandatory.</span>
                            <!-- /.box-body -->
                            <div class="" style="border-top:0">
                                <div class="box-footer">
                                    <button type="submit" id="updateCountryBtn" class="btn btn-info pull-right" style="margin-left: 20px;">Update</button>
                                    <button type="button" id="cancelBtn" class="btn btn-default pull-right">Back</button>
                                </div>
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

@section('css')
    <style>
        .form-group .select2-container {
            width: 100% !important;
        }
    </style>
@endsection

@section('script')
    @if(Session::has('message'))
        <script>
            $(function() {
            toastr.{{ Session::get('alert-class') }}('{{ Session::get('message') }}');
            });
        </script>
    @endif

    <script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/jquery.validate.js')}}"></script>
    <script src="{{URL::asset('resources/assets/custom/jQuery-validation-plugin/additional-methods.js')}}"></script>
    <script>
         $("#cancelBtn").click(function () {
            window.location.href = "{{url('admin/countries/'.$state->country_id)}}";
        });

        $(document.body).on('click', "#updateCountryBtn", function(){

            if ($("#editCountryForm").length){
                $("#editCountryForm").validate({
                    errorElement: 'span',
                    errorClass: 'text-red',
                    ignore: [],
                    rules: {
                        "state_name":{
                            required:true,
                            minlength: 2,
                            maxlength: 20
                        },
                    },
                    messages: {
                        "state_name":{
                            required:"Enter State name",
                        },
                    },
                    errorPlacement: function(error, element) {
                        error.insertAfter(element.closest(".form-control"));
                    },
                });
            }
        });

        var today = new Date();

        $('#dob').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true,
            endDate: "today",
            maxDate: today
        });

        var SITE_URL = "<?php echo URL::to('/'); ?>";

        function readURL(input) {
            var old_profile_image = $('#old_profile_image').val();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.old_profile_imageSub')
                        .attr('src', e.target.result)
                        .width(125)
                        .height(125);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#country').on('change', function(){
            $('#state').html('');
            $('#city').html('');
            var id = $('#country').val();
            var state = {{ !empty($country->state) ? $country->state: 'null' }};
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: SITE_URL+'/getState',
                data: {
                    id,
                    state
                },
                success: function(data) {
                    $('#state').html(data);
                }
            });
        });

        $('#state').on('change', function(){
            $('#city').html('');
            var id = $('#state').val();
            var city = {{ (!empty($country->city)) ? $country->city: 'null' }};
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: SITE_URL+'/getCity',
                data: {
                    id,
                    city
                },
                success: function(data) {
                    $('#city').html(data);
                }
            });
        });
    </script>
@endsection
