@section('title') User Chat | @endsection
@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>User Chat</h1>
        <ol class="breadcrumb">
        <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{url('admin/users')}}"> Users</a> </li>
        <li class="active">User Chat</li>
        </ol>
    </section>
        <!-- Main content -->
    <section class="content chat_page">
        <div class="row">
            <div class="col-sm-12">
                <!-- Horizontal Form -->
                <div class="box ">
                    <div class="chat_box_right">
                        <div class=" direct-chat direct-chat-primary">
                            <div class="msg_header">
                                <div id="msg_back" class="hidden-sm hidden-md hidden-lg">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M464.344,207.418l0.768,0.168H135.888l103.496-103.724c5.068-5.064,7.848-11.924,7.848-19.124
                                            c0-7.2-2.78-14.012-7.848-19.088L223.28,49.538c-5.064-5.064-11.812-7.864-19.008-7.864c-7.2,0-13.952,2.78-19.016,7.844
                                            L7.844,226.914C2.76,231.998-0.02,238.77,0,245.974c-0.02,7.244,2.76,14.02,7.844,19.096l177.412,177.412
                                            c5.064,5.06,11.812,7.844,19.016,7.844c7.196,0,13.944-2.788,19.008-7.844l16.104-16.112c5.068-5.056,7.848-11.808,7.848-19.008
                                            c0-7.196-2.78-13.592-7.848-18.652L134.72,284.406h329.992c14.828,0,27.288-12.78,27.288-27.6v-22.788
                                            C492,219.198,479.172,207.418,464.344,207.418z"/>
                                        </g>
                                    </g>
                                </svg>
                                </div>
                                <div class="img_user">
                                    <img src="{{$receptorUser->getOriginal('profile_image')?$receptorUser->profile_image:url('/images/9743b5bd2c6bc8ca09eb33ea163df169.png')}}">
                                </div>
                                <h3 class="user_name"><b>{{ $receptorUser->first_name }}<b></h3>
                            </div>
                            <div class="box-body">
                                <div class="direct-chat-messages" style="height:auto;">
                                    <firebase-messages user-id="{{ Auth::user()->id }}" chat-id="{{ $chat->id }}" user-name="{{  Auth::user()->first_name }}" receptor-name="{{ $receptorUser->first_name }}" receptor-image="{{$receptorUser->getOriginal('profile_image')?$receptorUser->profile_image:url('/images/9743b5bd2c6bc8ca09eb33ea163df169.png')}}"  user-image="{{ Auth::user()->getOriginal('profile_image')?Auth::user()->profile_image:url('/images/9743b5bd2c6bc8ca09eb33ea163df169.png') }}" receptor-id="{{ $receptorUser->id }}" projectapi-Url="{{ url('/api/updateMessageMysql') }}" projectapi-Url-Media="{{ url('/api/updateMedia') }}"></firebase-messages>
                                </div>
                            </div>
                        </div>
                        <div class="" style="border-top:0">
                            <div class="box-footer">
                                <a type="button" href="{{url('/admin/users')}}" id="cancelBtn" class="btn btn-default pull-right">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
</div>

@endsection

@section('css')
<style>
    .products-list .product-info {
        margin-top: 2px;
        font-size: 15px;
    }
    .ui.form {
        font-size: 1rem;
        position: relative;
    max-width: 100%;
    }
    .ui.form .field {
        clear: both;
        margin: 0 0 1em;
    }
    .ui.comments .reply.form textarea {
        font-size: 1em;
        height: 12em;
    }
    .ui.form textarea:not([rows]) {
        height: 12em;
        min-height: 5em;
        max-height: 5em;
        border-radius: 5px;
    }
    .ui.form input[type=checkbox], .ui.form textarea {
        vertical-align: top;
    }
    .ui.form textarea {
        margin: 0;
        -webkit-appearance: none;
        /* tap-highlight-color: rgba(255,255,255,0); */
        padding: .78571429em 1em;
        box-shadow: none;
    }

    .ui.button {
        cursor: pointer;
        padding: 5px 30px;
        color: #ffffff;
        background-color: #ef4426;
        border: none;
        border-radius: 2px;
        font-size: 15px;
    }
    .products-list{
        max-height: 550px;
    overflow-y: scroll;
    }
    .comment .content .text p{
        /* text-align: justify; */
    }
    /* Scrollbar styles */
    ::-webkit-scrollbar {
            width: 8px;
            height: 3px;
    }
    ::-webkit-scrollbar-track {
            /* box-shadow: inset 0 0 10px #31B0D5; */
            border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #ef4426;
            /* box-shadow: inset 0 0 6px rgba(0,0,0,0.5);  */
    }
    .date-filter{
        /* background-color: #dd4b39 !important; */
        background-color: #ef4426 !important;
        border-color: #367fa9;
        color: #ffffff !important;
        border: 1px solid transparent;
        border-radius: 3px;
    }
    .date-filter::-webkit-input-placeholder {
    color: #ffffff;
    }
    .product-description img{
        height: 20px;
    }

</style>
@endsection
@section('script')

@endsection