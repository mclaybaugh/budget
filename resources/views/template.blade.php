@extends('layouts.app')

@section('content')
<div class="flex-l justify-center">

  @foreach ($data as $cat => $records)
    @component('components.table_template', [
      'title' => $cat,
      'rows' => $records,
    ])
    @endcomponent
  @endforeach

</div>
<div class="center mw5 ba b--primary primary bg-transparent f6">
  <a class="link db primary tc b ph3 pv2"
  href="{{ route('template.create') }}">Add Template Transaction</a>
</div>
@endsection
