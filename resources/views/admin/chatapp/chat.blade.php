@extends('admin.layouts.adminMaster')

@section('title')
Chat |
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Chat</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Chat</li>
        </ol>
    </section>
    <section class="content">
        <div id="app" class="ui main">
            <div class="ui">
                <div class="row">
                    <div class="col-md-3">
                        <div class="three wide column">
                            <div class="ui vertical pointing menu" style="width:100%;">
                                <div class="box box-widget" style="    margin-bottom: 0;">
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <h4>User List</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    @foreach($users as $user)
                                        @if($user->id == $receptorUser->id)
                                            <a href="{{route('adminUserChat', [$user->id])}}" class="active item">
                                                {{ $user->first_name .' '. $user->last_name }}
                                            </a>
                                        @else
                                            <a href="{{route('adminUserChat', [$user->id])}}" class="item">
                                                {{ $user->first_name .' '. $user->last_name }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="thirteen wide column">
                            <div class="ui segment" style="padding: 1.5em 1.5em;">
                                <div class="ui comments" style="max-width: 100%;">
                                    <h3 class="ui dividing header"><i class="talk outline icon"></i> Conversation with {{ $receptorUser->first_name .' '. $receptorUser->last_name }}</h3>
                                    <firebase-messages user-id="{{ Auth::user()->id }}" chat-id="{{ $chat->id }}" receptor-name="{{ $receptorUser->first_name    }}" receptor-image="{{ $receptorUserImage }}"  user-image="{{ $userImage }}" receptor-id="{{ $receptorUser->id }}" projectapi-Url="{{ url('/api/saveLastMessage') }}" projectapi-Url-Media="{{ url('/api/updateMedia') }}"></firebase-messages>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/semantic/dist/semantic.min.css') }}">
<style>
    .sixteen .content{
        min-height: 0;
    }
    .sixteen .comment .content{
        background: #3c8dbc;
        border-color: #3c8dbc;
        color: white !important;
        margin-bottom: 5px;
        margin-right: 50px;
        margin-left: 0;
        border-radius: 10px;
        padding-top: 7px;
        padding-bottom: 1px;
    }
    .column.ss .comment .content{
        background: #d2d6de;
        border-color: #d2d6de;
        color: black !important;
        margin-bottom: 5px;
        margin-right: 50px;
        margin-left: 0;
        border-radius: 10px;
        padding-top: 7px;
        padding-bottom: 1px;
    }
    .comment .metadata,.comment .author,.comment .text{
        color: white !important;
    }
    .column.ss .comment .metadata,.column.ss .comment .author,.column.ss .comment .text{
        color: black !important;
    }

</style>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="{{ asset('public/semantic/dist/semantic.min.js') }}"></script>
    <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
          apiKey: "{{ env('FIREBASE_APIKEY') }}",
          authDomain: "{{ env('FIREBASE_AUTHDOMAIN') }}",
          databaseURL: "{{ env('FIREBASE_DATABASEURL') }}",
          projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
          storageBucket: "{{ env('FIREBASE_STORAGEBUCKET') }}",
          messagingSenderId: "{{ env('FIREBASE_MESSAGINGSENDER_ID') }}"
        };
        firebase.initializeApp(config);

        const database = firebase.database();
    </script>
    <script src="{{ asset('public/js/myapp.js') }}"></script>
@endsection
