@if($errors->isNotEmpty())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first('quote') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<form method="post" action="{{ route('quotes.store') }}">
  @csrf
  <div class="input-group mb-3 pb-3 border-bottom">
    <div class="input-group-prepend">
      <span class="input-group-text">Some say</span>
    </div>
    <input name="quote" type="text" class="form-control" value="{{ old('quote') }}">
    <div class="input-group-append">
      <button class="btn btn-success" type="submit">Submit</button>
    </div>
  </div>
</form>
