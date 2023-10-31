@extends('admin.layouts.adminMaster')

@section('title')
Chat User Not Found|
@endsection

@section('content')
    <div class="ui main container" style="margin-top:65px;">
        <div class="ui grid">
            <div class="row">
                <div class="four wide column">
                    <div class="ui cards">
                      <div class="card">
                        <div class="image">
                          <img src="{{asset('img/avatar/default.jpg')}}">
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
                        User "{{ $userName }}" not found.
                        </h2>
                        <img class="ui medium rounded image" src="{{asset('img/darth-vader-face-palm.jpg')}}">
                        <br>
                        <a href="{{route('inicio')}}" class="ui teal button">Go to start</a>
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