@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header"><strong>Delete Account</strong></div>
          <div class="card-body">
            <p>You are able to delete your account entirely, this is irreversible.</p>
            <p>Deleting your account <strong>will</strong>:</p>
            <ul>
              <li>Dissociate your account from any quotes you may have submitted</li>
              <li>Completely delete your user account on Stig Quotes</li>
              <li>Log you out of your account</li>
            </ul>
            <hr>
            <p>Deleting your account <strong>will not</strong>:</p>
            <ul>
              <li>Delete or affect your Twitter account in anyway</li>
              <li>Revoke access, you will need to do this via <a href="https://twitter.com/settings/applications" target="_blank">Twitter application settings</a></li>
            </ul>
          </div>
          <div class="card-footer">
            <a href="{{ route('account.delete') }}" class="btn btn-danger">Delete Account</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
