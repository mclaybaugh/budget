@extends('layouts.app')
@section('pageTitle')
Transaction Generate
@endsection
@section('content')
<form method="POST" action="/transaction/run" class="measure center pt4">
  @csrf

  @component('components.select', [
    'short' => 'year',
    'display' => 'Year',
    'options' => $years,
  ])
  @endcomponent

  @component('components.select', [
    'short' => 'month',
    'display' => 'Month',
    'options' => $months,
  ])
  @endcomponent

  @component('components.submit', [
    'display' => 'Submit',
    'colors' => 'ba b--primary primary',
  ])
  @endcomponent

</form>
@endsection
