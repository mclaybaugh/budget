@extends('layouts.app')
@section('pageTitle')
Transaction Edit
@endsection
@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => route('transaction.update', $item->id),
])
  @method('PATCH')
  @component('components.messages')
  @endcomponent

  <!-- description text max 100 -->
  @component('components.input', [
    'short' => 'description',
    'display' => 'Description',
    'type' => 'text',
    'maxlength' => '100',
    'value' => $item->description,
  ])
  @endcomponent
  <!-- category select options -->
  @component('components.select', [
    'short' => 'category_id',
    'display' => 'Category',
    'options' => $categories,
    'value' => $item->category_id,
  ])
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
  'route' => route('transaction.destroy', $item->id),
])
  @method('DELETE')
  @component('components.submit', [
    'display' => 'Delete',
    'colors' => 'ba b--comp comp',
  ])
  @endcomponent
@endcomponent
@endsection
