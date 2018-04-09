<div class="btn-group">
  <a class="btn btn-twitter-blue" href="{{ linkUser(auth()->user()->nickname) }}" target="_blank">{{ auth()->user()->name }}</a>
  <button type="button" class="btn btn-twitter-blue dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Settings</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a>
  </div>
</div>
