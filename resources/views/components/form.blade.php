{{-- form.blade.php 

  params:
  - route
  - method
--}}
<form class="measure center" method="{{ $method }}" action="{{ $route }}">
  @csrf
  {{ $slot }}
</form>