@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('template.store') }}" class="measure center pt4">
  @csrf
  <!-- description text max 100 -->
  @component('components.input', [
    'short' => 'description',
    'display' => 'Description',
    'type' => 'text',
    'maxlength' => '100',
  ])
  @endcomponent
  <!-- category select options -->
  @component('components.select', [
    'short' => 'category_id',
    'display' => 'Category',
    'options' => $categories,
  ])
  @endcomponent
  <!-- amount numeric 8:2 -->
  @component('components.input', [
    'short' => 'amount',
    'display' => 'Amount',
    'type' => 'number',
    'max' => '100000000',
  ])
  @endcomponent
  <!-- datetime text "YYYY-MM-DD hh:mm:ss" max 19 -->
  @component('components.input', [
    'short' => 'datetime',
    'display' => 'Date and Time',
    'type' => 'text',
    'maxlength' => '19',
    'placeholder' => 'YYYY-MM-DD hh:mm:ss',
  ])
  @endcomponent
  <!-- interval_days number max 366  min 0 -->
  @component('components.input', [
    'short' => 'interval_days',
    'display' => 'Interval (days)',
    'type' => 'number',
    'max' => '366',
  ])
  @endcomponent

  @component('components.submit', [
    'display' => 'Submit',
    'colors' => 'ba b--primary primary',
  ])
  @endcomponent

</form>
@endsection
