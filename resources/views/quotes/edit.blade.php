@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        @if($errors->isNotEmpty())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('quote') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <form method="post" action="{{ route('quotes.update', $quote) }}">
          @csrf
          @method('PUT')
          <div class="input-group">
            <input name="quote" type="text" class="form-control" value="{{ old('quote', $quote->body) }}">
            <div class="input-group-append">
              <button class="btn btn-success" type="submit">Submit Edit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
