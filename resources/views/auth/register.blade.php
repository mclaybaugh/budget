@extends('layouts.app')
@section('pageTitle')
Register
@endsection
@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => route('register'),
])
  @component('components.fieldset', [
    'title' => 'Register',
  ])

    @component('components.input', [
      'short' => 'name',
      'display' => 'Name',
      'type' => 'text',
      'value' => old('name'),
      'autocomplete' => TRUE,
      'autofocus' => TRUE,
    ])
    @endcomponent
  
    @component('components.input', [
      'short' => 'email',
      'display' => 'Email Address',
      'type' => 'email',
      'value' => old('email'),
      'autocomplete' => TRUE,
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
      'text' => 'Register',
    ])
    @endcomponent

  @endcomponent
@endcomponent
@endsection
