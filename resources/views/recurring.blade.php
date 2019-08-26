@extends('layouts.app')

@section('content')
<ul class="silver">
  @foreach ($recurring as $record)
  <li>{{ $record->id }}
    <ul>
      @foreach ($record as $key => $value)
      <li>{{ $key }}: {{ $value }}</li>
      @endforeach
    </ul>
  </li>
  @endforeach
</ul>
@endsection
