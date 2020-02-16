@extends('layouts.app')
@section('pageTitle')
{{ $title }} Transactions
@endsection
@section('content')
@if (!empty($message))
  <p>{{ $message }}<p>
@endif
<div class="view-transactionMonth flex-l justify-center">

  <div class="overflow-auto pa3">
    @component('components.ghost_link', [
      'route' => $prevHref,
      'text' => $prevText,
    ])
    @endcomponent
    @component('components.ghost_link', [
      'route' => $nextHref,
      'text' => $nextText,
    ])
    @endcomponent
  </div>

  @if (count($rows) > 0)
    @component('components.table_transaction', [
      'title' => $title,
      'rows' => $rows,
    ])
    @endcomponent
  @endif

  <div class="overflow-auto pa3">
    
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
    @component('components.ghost_link', [
      'route' => '/transaction/update-today',
      'text' => 'Update Today',
    ])
    @endcomponent
  </div>
</div>

@endsection
