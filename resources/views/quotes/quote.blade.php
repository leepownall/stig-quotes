<div class="row">
  <div class="col-12 mb-3">
    <div class="card">
      @if($quote->user)
        <h6 class="card-header">
          {{ $quote->user->name }}
          <small>
            <a
              href="{{ linkUser($quote->user->nickname) }}"
              target="_blank"
            >
              {{ '@' . $quote->user->nickname }}
            </a>
          </small>
        </h6>
      @endif
      <div class="card-body">
        <p class="card-text">{{ $quote->body }}</p>
      </div>
      @if($quote->hasBeenTweeted)
        <div class="card-footer">
          <span class="text-muted"><small> {!! $quote->lastTweetedAt !!}</small></span>
        </div>
      @endif
    </div>
  </div>
</div>
