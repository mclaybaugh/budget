@extends('layouts.app')
@section('pageTitle')
Transaction Generate
@endsection
@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => '/transaction/run',
])
  @component('components.messages')
  @endcomponent

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
