@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        @include('quotes.create')
      </div>
    </div>
    @each('quotes.quote', $quotes, 'quote')
    {{ $quotes->links() }}
  </div>
@endsection
