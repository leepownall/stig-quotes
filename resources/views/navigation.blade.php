<nav class="navbar navbar-dark bg-dark flex-nowrap flex-row mb-3 px-0">
  <div class="container">
    <ul class="navbar-nav flex-row float-right">
      <li class="nav-item pr-3 active">
        <a class="nav-link" href="{{ route('quotes.index') }}">Latest <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    @if(auth()->check())
      @include('partials.user')
    @else
      @include('partials.login')
    @endif
  </div>
</nav>
