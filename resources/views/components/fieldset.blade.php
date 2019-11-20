{{-- form.blade.php 

  params:
  - title
--}}
<fieldset class="ba b--transparent ph0 mh0">
  @isset($title)
  <legend class="f4 fw6 ph0 mh0 white">{{ $title}}</legend>
  @endisset
  {{ $slot }}
</fieldset>