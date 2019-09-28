@extends('layouts.app')
@section('pageTitle')
Template Edit |
@endsection
@section('content')
<div class="measure center pt4">
  <form method="POST" action="{{ route('template.update', $item->id) }}">
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
  </form>

  <form action="{{ route('template.destroy', $item->id)}}" method="post">
    @csrf
    @method('DELETE')
    @component('components.submit', [
      'display' => 'Delete',
      'colors' => 'ba b--comp comp',
    ])
    @endcomponent
  </form>
</div>
@endsection
