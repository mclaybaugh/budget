@extends('layouts.app')
@section('pageTitle')
Balance Create
@endsection
@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => route('balance.store'),
])
  @component('components.messages')
  @endcomponent
  
  <!-- amount numeric 8:2 -->
  @component('components.input', [
    'short' => 'amount',
    'display' => 'Amount',
    'type' => 'number',
    'max' => '100000000',
  ])
  @endcomponent

  @component('components.input', [
    'short' => 'date',
    'display' => 'Date',
    'type' => 'date',
    'value' => date('Y-m-d'),
  ])
  @endcomponent

  @component('components.input', [
    'short' => 'time',
    'display' => 'Time',
    'type' => 'time',
    'value' => '00:00',
  ])
  @endcomponent

  @component('components.submit', [
    'display' => 'Submit',
    'colors' => 'ba b--primary primary',
  ])
  @endcomponent

@endcomponent
@endsection