{{-- select.blade.php 

  params:
  - short
  - display
  - options [ value => display ]
--}}

<div class="mt3">
  <label class="db fw6 lh-copy f6 silver"
  for="{{ $short }}">{{ $display }}</label>
  <select class=""
  name="{{ $short }}" id="{{ $short }}">
    <option>Select ...</option>
      @foreach ($options as $value => $display)
        <option value="{{ $value }}">{{ $display }}</option>
      @endforeach
  </select>
</div>