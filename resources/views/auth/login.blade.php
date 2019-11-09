@extends('layouts.app')

@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => route('login'),
])
  <fieldset id="sign_up" class="ba b--transparent ph0 mh0">
    <legend class="f4 fw6 ph0 mh0 white">Login</legend>
    <div class="mt3">
      <label class="db fw6 lh-copy f6 silver" for="email">Email Address</label>
      <input class="light-silver pa2 input-reset ba bg-transparent w-100 @error('email') is-invalid b--comp @enderror"
      type="email" name="email"  id="email">
      @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="mv3">
      <label class="db fw6 lh-copy f6 silver" for="password">Password</label>
      <input class="light-silver b pa2 input-reset bb bg-transparent w-100 @error('email') is-invalid b--comp @enderror"
      type="password" name="password"  id="password">
      @error('password')
        <span class="invalid-feedback comp" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <label class="pa0 ma0 lh-copy f6 pointer silver">
      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
    </label>
  </fieldset>
  <input class="b ph3 pv2 input-reset ba b--primary primary bg-transparent pointer f6 dib" type="submit" value="Login">
  @if (Route::has('password.request'))
    <div class="lh-copy mt3">
      <a href="{{ route('password.request') }}" class="f6 link dim black db silver">Forgot your password?</a>
    </div>
  @endif
@endcomponent
@endsection
