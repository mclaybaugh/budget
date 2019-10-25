@extends('layouts.app')
@section('pageTitle')
Balance
@endsection
@section('content')
<div class="flex-l justify-center">
  @if (count($records) > 0)
    @component('components.table_balance', [
      'title' => 'Balances',
      'rows' => $records,
    ])
    @endcomponent
  
  @endif
</div>

@component('components.ghost_link', [
  'route' => route('balance.create'),
  'text' => 'Add Balance',
])
@endcomponent
@endsection
