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
      'required' => TRUE,
      'autocomplete' => TRUE,
      'autofocus' => TRUE,
    ])
    @endcomponent
  
    @component('components.input', [
      'short' => 'email',
      'display' => 'Email Address',
      'type' => 'email',
      'value' => old('email'),
      'required' => TRUE,
      'autocomplete' => TRUE,
    ])
    @endcomponent

    @component('components.input', [
      'short' => 'password',
      'display' => 'Password',
      'type' => 'password',
      'required' => TRUE,
      'autocomplete' => TRUE,
    ])
    @endcomponent

    @component('components.input', [
      'short' => 'password_confirmation',
      'display' => 'Confirm Password',
      'type' => 'password',
      'required' => TRUE,
      'autocomplete' => TRUE,
    ])
    @endcomponent

    <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
          {{ __('Register') }}
        </button>
      </div>
    </div>
  @endcomponent
@endcomponent
@endsection
