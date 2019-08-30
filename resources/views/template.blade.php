@extends('layouts.app')

@section('content')
<div class="flex-l justify-center">
  @component('components.table_template', [
    'title' => 'Income',
    'rows' => $data['income'],
  ])
  @endcomponent

  @component('components.table_template', [
    'title' => 'Fixed Expenses',
    'rows' => $data['fixed'],
  ])
  @endcomponent

  @component('components.table_template', [
    'title' => 'Income',
    'rows' => $data['variable'],
  ])
  @endcomponent
</div>
<div class="center mw5 ba b--primary primary bg-transparent f6">
  <a class="link db primary tc b ph3 pv2"
  href="{{ route('template.create') }}">Add Template Transaction</a>
</div>
@endsection
