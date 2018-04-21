<div class="row" id="quote-{{ $quote->id }}">
  <div class="col-12 mb-3">
    <div class="card">
      @if($quote->user)
        <h6 class="card-header">
          {{ $quote->user->name }}
          <small>
            <a href="{{ linkUser($quote->user->nickname) }}" target="_blank">{{ '@' . $quote->user->nickname }}</a>
          </small>
        </h6>
      @endif
      <div class="card-body">
        <p class="card-text">{{ $quote->body }}</p>
      </div>
      <div class="card-footer">
        <span class="text-muted">
          <small>Retweets ({{ $quote->tweets->sum('retweet_count') }}) -</small>
        </span>
        <span class="text-muted">
          <small>Favourites ({{ $quote->tweets->sum('favorite_count') }})</small>
        </span>
        @if($quote->hasBeenTweeted)
          <span class="text-muted"><small>- {!! $quote->lastTweetedAt !!}</small></span>
        @endif
        <div class="float-right">
          @can('edit', $quote)
            <a class="btn btn-sm btn-outline-info" href="{{ route('quotes.edit', $quote) }}">Edit</a>
          @endcan
          @can('delete', $quote)
            <form action="{{ route('quotes.destroy', $quote) }}" method="POST" class="d-inline-block">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          @endcan
        </div>
      </div>
    </div>
  </div>
</div>
