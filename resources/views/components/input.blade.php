{{-- input.blade.php 
  For use with text/number input types including:
  1. text
  2. email
  3. tel

  params:
  - short
  - display
  - type
  - maxlength (text)
  - max (number)
  - placeholder
  - value
  - required
  - autocomplete
  - autofocus
--}}

<div class="mv3">
  <label class="db fw6 lh-copy f6 silver"
  for="{{ $short }}">{{ $display }}</label>
  <input class="light-silver pa2 input-reset ba bg-transparent w-100 @error('{{ $short }}') b--comp @enderror"
  type="{{ $type }}" name="{{ $short }}" id="{{ $short }}"
  @isset($maxlength) maxlength="{{ $maxlength }}" @endisset
  @isset($max) maxlength="{{ $max }}" @endisset
  @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
  @isset($value) value="{{ $value }}" @endisset
  @if (!isset($optional)) required="required" @endif
  @isset($autocomplete) autocomplete="{{ $short }}" @endisset
  @isset($autofocus) autofocus @endisset
  />
  @error('{{ $short }}')
    <span class="comp" role="alert">
      <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>
