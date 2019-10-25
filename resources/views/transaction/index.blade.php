@extends('layouts.app')
@section('pageTitle')
Transaction
@endsection
@section('content')
<div class="flex-l justify-center">
  @if (count($rows) > 0)
    @component('components.table_transaction', [
      'title' => $title,
      'rows' => $rows,
    ])
    @endcomponent
  @endif
</div>

@component('components.ghost_link', [
  'route' => route('transaction.create'),
  'text' => 'Add Transaction',
])
@endcomponent
@component('components.ghost_link', [
  'route' => '/transaction/generate',
  'text' => 'Generate Transactions from Template',
])
@endcomponent

@endsection
