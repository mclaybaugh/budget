<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- fonts -->

  <!-- Styles -->
  <link href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="depth-0 text-0">
  <div id="app">
    <nav class="bb b--dark-gray db dt-l w-100 border-box pa3 ph5-l">
      <a class="db dtc-l v-mid primary link dim w-100 w-25-l tc tl-l mb2 mb0-l" href="/" title="Home">
        {{ config('app.name', 'Laravel') }}
          @auth
          <span class="f6 f5-l dib mr3 mr4-l">
            - {{ Auth::user()->name }}
          </span>
          @endauth
      </a>
      <div class="db dtc-l v-mid w-100 w-75-l tc tr-l">
      @guest
        <a class="link dim f6 f5-l dib mr3 mr4-l" href="{{ route('login') }}">
          Login
        </a>
        @if (Route::has('register'))
          <a class="link dim f6 f5-l dib mr3 mr4-l" href="{{ route('register') }}">
            Register
          </a>
        @endif
      @else
        <a class="link light-silver dim f6 f5-l dib mr3 mr4-l" href="/template">
          Template
        </a>
        <a class="link light-silver dim f6 f5-l dib mr3 mr4-l" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      @endif
      </div>
    </nav>
    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>
</html>
