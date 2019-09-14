@extends('layouts.app')

@section('pageTitle')
Template |
@endsection

@section('content')
@foreach ($data as $cat => $records)
  @component('components.template_category', [
    'title' => $cat,
    'rows' => $records,
  ])
  @endcomponent
@endforeach

<div class="center mw5 ba b--primary primary bg-transparent f6">
  <a class="link dim db primary tc b ph3 pv2"
  href="{{ route('template.create') }}">Add Template Transaction</a>
</div>

@endsection
