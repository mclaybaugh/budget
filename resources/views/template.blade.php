@extends('layouts.app')

@section('content')
<div class="flex-l">
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
</div>

<a class="link db center tc mw5 b ph3 pv2 ba b--primary primary bg-transparent pointer f6"
href="/template/create">Add Template Transaction</a>
@endsection
