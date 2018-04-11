@if(session()->has('status'))
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {!! session('status') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>
@endif
