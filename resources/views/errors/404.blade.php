@extends('layouts.dashboardErrors')

@section('title', __('Not Found'))
{{-- @section('code', '404')
@section('message', __('Not Found')) --}}

@section('content')
      <div class="misc-wrapper"><a class="brand-logo" href="javascript:void(0);">

              <h2 class="brand-text text-primary ml-1">{{config('app.name')}}</h2></a>
            <div class="misc-inner p-2 p-sm-3">
              <div class="w-100 text-center">
                <h2 class="mb-1">Page Not Found 🕵🏻‍♀️</h2>
                <p class="mb-2">Oops! 😖 The requested URL was not found on this server.</p><a class="btn btn-primary mb-2 btn-sm-block" href="{{ url()->previous()}}">Back to home</a><img class="img-fluid" src="{{asset('app-assets\images\pages\error.svg')}}" alt="Error page">
              </div>
            </div>
          </div>

@endsection
