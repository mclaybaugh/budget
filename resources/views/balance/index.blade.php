@extends('layouts.app')
@section('pageTitle')
Balance |
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

<div class="center mw5 ba b--primary primary bg-transparent f6">
  <a class="link dim db primary tc b ph3 pv2"
  href="{{ route('balance.create') }}">Add Template Transaction</a>
</div>
@endsection
