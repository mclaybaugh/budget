{{-- ghost_btn.blade.php 

  params:
  - text
  - extraClasses
--}}
<button class="@isset($extraClasses){{ $extraClasses }}@endisset link dim db primary tc b ph3 pv2 ba b--primary primary bg-transparent f6 pointer">
  {{ $text }}
</button>