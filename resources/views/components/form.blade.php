{{-- form.blade.php 

  params:
  - route
  - method
--}}
<form class="measure center pt4" method="{{ $method }}" action="{{ $route }}">
  @csrf
  {{ $slot }}
</form>