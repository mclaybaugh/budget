@extends('layouts.app')
@section('pageTitle')
Forgot Password
@endsection
@section('content')

@component('components.form', [
  'method' => 'POST',
  'route' => route('password.email'),
])

  @if (session('status')) {{ session('status') }} @endif

  @component('components.fieldset', [
    'title' => 'Reset Password',
  ])

    @component('components.input', [
      'short' => 'email',
      'display' => 'Email Address',
      'type' => 'email',
      'value' => old('email'),
      'autocomplete' => TRUE,
      'autofocus' => TRUE,
    ])
    @endcomponent

    @component('components.ghost_btn', [
      'text' => 'Send Password Reset Link',
    ])
    @endcomponent

  @endcomponent {{-- fieldset --}}

@endcomponent {{-- form --}}
@endsection
