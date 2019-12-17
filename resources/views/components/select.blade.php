{{-- select.blade.php 

  params:
  - short
  - display
  - options [ value => display ]
  - value
--}}

<div class="mt3">
  <label class="db fw6 lh-copy f6 silver"
  for="{{ $short }}">{{ $display }}</label>
  <select name="{{ $short }}" id="{{ $short }}"
  @if (!isset($optional)) required="required" @endif>
    <option value="">Select ...</option>
      @foreach ($options as $val => $display)
        <option value="{{ $val }}"
        @isset($value)
          @if ($val == $value)
          selected="selected"
          @endif
        @endisset>
          {{ $display }}
        </option>
      @endforeach
  </select>
</div>