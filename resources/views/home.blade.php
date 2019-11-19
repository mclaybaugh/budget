@extends('layouts.app')
@section('pageTitle')
Home
@endsection
@section('content')
<article class="center mw5 mw6-ns br3 hidden ba b--gray mv4">
  <h2 class="f4 bg-near-black br3 br--top black-60 mv0 pv2 ph3 silver">Title of card</h1>
  <div class="pa3 bt b--gray">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    <p class="f6 f5-ns lh-copy measure silver">
        You are logged in!
    </p>
  </div>
</article>
@endsection
