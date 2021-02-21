@extends('layouts.dashboard')
@section('content')
    <div class="content-wrapper">

          <router-view :authuser="{{ Auth::user() }}"></router-view>
    </div>
@endsection
