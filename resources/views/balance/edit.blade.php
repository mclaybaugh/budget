@extends('layouts.app')
@section('pageTitle')
Balance Edit
@endsection
@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => route('balance.update', $item->id),
])
  @method('PATCH')
  @component('components.messages')
  @endcomponent

  <!-- amount numeric 8:2 -->
  @component('components.input', [
    'short' => 'amount',
    'display' => 'Amount',
    'type' => 'number',
    'max' => '100000000',
    'step' => '0.01',
    'value' => $item->amount,
  ])
  @endcomponent

  @component('components.input', [
    'short' => 'date',
    'display' => 'Date',
    'type' => 'date',
    'value' => $item->date,
  ])
  @endcomponent

  @component('components.input', [
    'short' => 'time',
    'display' => 'Time',
    'type' => 'time',
    'value' => $item->time,
  ])
  @endcomponent

  @component('components.submit', [
    'display' => 'Submit',
    'colors' => 'ba b--primary primary',
  ])
  @endcomponent
@endcomponent

@component('components.form', [
  'method' => 'POST',
  'route' => route('balance.destroy', $item->id),
])
  @method('DELETE')
  @component('components.submit', [
    'display' => 'Delete',
    'colors' => 'ba b--comp comp',
  ])
  @endcomponent
@endcomponent

@endsection
