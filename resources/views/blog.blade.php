@extends('layouts.app')

@section('content')
  <x-common.blog-navbar />

  <x-common.blog-head-image />

  <div class="alert alert-primary mt-1" role="alert" id="welcomeMessage"></div>

  <x-common.welcome-message />

  <x-common.session-alert key="draftMsg" type="danger" />
  <x-common.session-alert key="login_message" type="success" />
  <x-common.session-alert key="logout_message" type="success" />
  <x-common.session-alert key="posted" type="success" />

  <x-form.tag-search :tags="$tags" />

  <x-common.posts-grid :posts="$posts" />

  @auth
  <x-common.add-post-button :userRole="auth()->user()->role" />

  <x-common.pending-post-button :userRole="auth()->user()->role" />

  <x-form.logout-button />
  @endauth

  @if(auth())
    asdasd
  @endif


@endsection

@section('style')
  <link href="{{ asset('style.css') }}" rel="stylesheet">
@endsection

@section('script')
  <script src="{{ asset('script.js') }}"></script>
@endsection
