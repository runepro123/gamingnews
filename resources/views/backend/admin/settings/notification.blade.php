@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notification Settings</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('backend.message')
            <div class="card">
              <form action="{{ url('settings/notification/update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>FCM Server Key</label>
                    <textarea name="fcm_server_key" class="form-control" placeholder="FCM Server Key">{{ $notificationSetting->fcm_server_key }}</textarea>
                    <span class="text-danger">{{ $errors->has('fcm_server_key') ? $errors->first('fcm_server_key') : "" }}</span>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection