{{-- ghost_link.blade.php 

  params:
  - route
  - text
  - class
--}}
<div class="center mw5 ma3 ba b--primary primary bg-transparent f6">
  <a class="@isset($class){{$class}}@endisset link dim db primary tc b ph3 pv2"
  href="{{ $route }}">{{ $text }}</a>
</div>