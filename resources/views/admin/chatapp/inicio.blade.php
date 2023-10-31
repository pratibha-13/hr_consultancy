@extends('admin.layouts.adminMaster')

@section('title')
Chat |
@endsection

@section('content')
<?php \Carbon\Carbon::setLocale('en');?>
    <div class="ui main container" style="margin-top:65px;">
        <div class="ui grid">
            <div class="row">
                <div class="four wide column">
                    <div class="ui cards">
                      <div class="card">
                        <div class="image">
                          <img src="{{asset('public/img/default.jpg')}}">
                        </div>
                        <div class="content">
                          <a class="header">{{ Auth::user()->name }}</a>
                          <div class="meta">
                            <span class="date">Registered {{Auth::user()->created_at->diffForHumans()}}</span>
                          </div>
                        </div>
                        <div class="extra content">
                            <a>
                                <i class="user circle icon"></i>
                                {{ Auth::user()->username }}
                            </a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="twelve wide column">
                    <div class="ui segment" style="padding: 1.5em 1.5em;">
                        <h2 class="ui dividing header">
                        Users: 
                        </h2>
                        <div id="app" class="ui two columns grid cards ">
                            @foreach($users as $user)
                                <div class="card">
                                    <div class="content">

                                        @if($user->isNew())
                                            <div class="ui yellow right ribbon label">
                                                <i class="star icon"></i> New user
                                            </div>
                                        @else
                                            <div class="ui teal right ribbon label">
                                                <i class="user circle icon"></i> User
                                            </div>
                                        @endif
                                        
                                        <div class="header">
                                          <img class="left floated mini ui image" src="{{asset('public/img/default.jpg')}}">
                                          {{$user->name}}
                                        </div>
                                        <div class="meta">                              
                                        Registered {{ $user->created_at->diffForHumans()}}
                                        </div>
                                        <div class="description">
                                          
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <div class="ui">
                                            <a href="{{route('chat', [$user->id])}}" class="ui fluid basic teal button"><i class="talk outline icon"></i> Chat</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$users->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/semantic/dist/semantic.min.css') }}">
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="{{ asset('public/semantic/dist/semantic.min.js') }}"></script>
@endsection