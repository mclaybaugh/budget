@extends('layouts.app')
@section('pageTitle')
Transaction Create
@endsection
@section('content')
@component('components.form', [
  'method' => 'POST',
  'route' => route('transaction.store'),
])
  @component('components.messages')
  @endcomponent

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
