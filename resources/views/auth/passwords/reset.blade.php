@extends('layouts.app')
@section('pageTitle')
Password Reset
@endsection
@section('content')

@component('components.form', [
  'method' => 'POST',
  'route' => route('password.update'),
])

  @if (session('status')) {{ session('status') }} @endif

  @component('components.fieldset', [
    'title' => 'Reset Password',
  ])

    <input type="hidden" name="token" value="{{ $token }}">

    @component('components.input', [
      'short' => 'email',
      'display' => 'Email Address',
      'type' => 'email',
      'value' => $email ?? old('email'),
      'autocomplete' => TRUE,
      'autofocus' => TRUE,
    ])
    @endcomponent

    @component('components.input', [
      'short' => 'password',
      'display' => 'Password',
      'type' => 'password',
      'autocomplete' => TRUE,
    ])
    @endcomponent

    @component('components.input', [
      'short' => 'password_confirmation',
      'display' => 'Confirm Password',
      'type' => 'password',
      'autocomplete' => TRUE,
    ])
    @endcomponent

    @component('components.ghost_btn', [
      'text' => 'Reset Password',
    ])
    @endcomponent

  @endcomponent {{-- fieldset --}}
@endcomponent {{-- form --}}

@endsection
