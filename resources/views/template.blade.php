@extends('layouts.app')

@section('content')
@component('components.table_template', [
  'title' => 'Income',
  'records' => $data['income'],
])
@endcomponent

@component('components.table_template', [
  'title' => 'Fixed Expenses',
  'records' => $data['fixed'],
])
@endcomponent

@component('components.table_template', [
  'title' => 'Income',
  'records' => $data['variable'],
])
@endcomponent

<a class="link mt3 b ph3 pv2 ba b--primary primary bg-transparent pointer f6 dib"
href="/template/create">Add Template Transaction</a>
@endsection
