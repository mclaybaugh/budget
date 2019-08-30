@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('template.update', $item->id) }}"
  class="measure center pt4">
  @method('PATCH')
  @csrf
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
    'short' => 'category',
    'display' => 'Category',
    'options' => [
      'income' => 'Income',
      'utility' => 'Utility',
      'insurance' => 'Insurance',
      'loan' => 'Loan',
      'creditcard' => 'Credit Card',
      'variable' => 'Variable',
    ],
    'value' => $item->category,
  ])
  @endcomponent
  <!-- amount numeric 8:2 -->
  @component('components.input', [
    'short' => 'amount',
    'display' => 'Amount',
    'type' => 'number',
    'max' => '100000000',
    'value' => $item->amount,
  ])
  @endcomponent
  <!-- datetime text "YYYY-MM-DD hh:mm:ss" max 19 -->
  @component('components.input', [
    'short' => 'datetime',
    'display' => 'Date and Time',
    'type' => 'text',
    'maxlength' => '19',
    'placeholder' => 'YYYY-MM-DD hh:mm:ss',
    'value' => $item->datetime,
  ])
  @endcomponent
  <!-- interval_days number max 366  min 0 -->
  @component('components.input', [
    'short' => 'interval_days',
    'display' => 'Interval (days)',
    'type' => 'number',
    'max' => '366',
    'value' => $item->interval_days,
  ])
  @endcomponent

  @component('components.submit', [
    'display' => 'Submit',
    'colors' => 'ba b--primary primary',
  ])
  @endcomponent

  <form action="{{ route('template.destroy', $item->id)}}" method="post">
    @csrf
    @method('DELETE')
    @component('components.submit', [
      'display' => 'Delete',
      'colors' => 'ba b--comp comp',
    ])
    @endcomponent
  </form>

</form>
@endsection
