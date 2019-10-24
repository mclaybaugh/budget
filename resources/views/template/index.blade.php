@extends('layouts.app')

@section('pageTitle')
Template |
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

<div class="center mw5 ba b--primary primary bg-transparent f6">
  <a class="link dim db primary tc b ph3 pv2"
  href="{{ route('template.create') }}">Add Template Transaction</a>
</div>

@endsection
