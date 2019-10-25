@extends('layouts.app')

@section('pageTitle')
Template
@endsection

@section('content')
<div class="flex-l justify-center">
  @foreach ($data as $cat => $records)
    @if (count($records) > 0)
      @component('components.table_template', [
        'title' => $cat,
        'rows' => $records,
      ])
      @endcomponent
    @endif
  @endforeach
</div>

@component('components.ghost_link', [
  'route' => 'template.create',
  'text' => 'Add Template Transaction',
])
@endcomponent
@endsection
