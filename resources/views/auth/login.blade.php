@extends('layouts.app')
@section('pageTitle')
Login
@endsection
@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => route('login'),
])
  @component('components.fieldset', [
    'title' => 'Login',
  ])
    @component('components.input', [
      'short' => 'email',
      'display' => 'Email Address',
      'type' => 'email',
    ])
    @endcomponent

    @component('components.input', [
      'short' => 'password',
      'display' => 'Password',
      'type' => 'password',
    ])
    @endcomponent

    <label class="pa0 ma0 lh-copy f6 pointer silver">
      <input type="checkbox" name="remember" id="remember"
      {{ old('remember') ? 'checked' : '' }}> Remember me
    </label>

  @endcomponent

  <input class="b ph3 pv2 input-reset ba b--primary primary bg-transparent pointer f6 dib" type="submit" value="Login">
  @if (Route::has('password.request'))
    <div class="lh-copy mt3">
      <a href="{{ route('password.request') }}" class="f6 link dim black db silver">Forgot your password?</a>
    </div>
  @endif

@endcomponent
@endsection
