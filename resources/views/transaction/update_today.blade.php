@extends('layouts.app')
@section('pageTitle')
Update Today
@endsection
@section('content')
<div class="measure center js-updateToday">

  <!-- Show current balance -->
  <p>
    Current Expected Balance: <span class="balance">{{$balance}}</span>
  </p>

  <!-- amount numeric 8:2 -->
  @component('components.input', [
    'short' => 'actual_balance',
    'display' => 'Actual Balance',
    'type' => 'number',
    'max' => '100000000',
    'step' => '0.01',
  ])
  @endcomponent

  <p>
    Difference: <span class="difference"></span>
  </p>

  @component('components.ghost_link', [
    'route' => route('transaction.create'),
    'text' => 'Add Transaction',
    'class' => 'updateLink',
  ])
  @endcomponent
</div>
@endsection