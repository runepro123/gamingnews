@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mail Configuration</h1>
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
              <form action="{{ url('settings/mail-configuration/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mail_host">Mail Host</label>
                        <input type="text" class="form-control" name="mail_host" value="{{ $mailConfiguration->mail_host }}" placeholder="Mail Host" >
                        <span class="text-danger">{{ $errors->has('mail_host') ? $errors->first('mail_host') : "" }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mail_port">Mail Port</label>
                        <input type="text" class="form-control" name="mail_port" value="{{ $mailConfiguration->mail_port }}" placeholder="Mail Port" >
                        <span class="text-danger">{{ $errors->has('mail_port') ? $errors->first('mail_port') : "" }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mail_username">Mail Username</label>
                        <input type="text" class="form-control" name="mail_username" value="{{ $mailConfiguration->mail_username }}" placeholder="Mail Username" >
                        <span class="text-danger">{{ $errors->has('mail_username') ? $errors->first('mail_username') : "" }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mail_password">Mail Password</label>
                        <input type="text" class="form-control" name="mail_password" value="{{ $mailConfiguration->mail_password }}" placeholder="Mail Password" >
                        <span class="text-danger">{{ $errors->has('mail_password') ? $errors->first('mail_password') : "" }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mail_encryption">Mail Encryption</label>
                        <input type="text" class="form-control" name="mail_encryption" value="{{ $mailConfiguration->mail_encryption }}" placeholder="Mail Encryption" >
                        <span class="text-danger">{{ $errors->has('mail_encryption') ? $errors->first('mail_encryption') : "" }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mail_from_address">Mail From Address</label>
                        <input type="text" class="form-control" name="mail_from_address" value="{{ $mailConfiguration->mail_from_address }}" placeholder="Mail From Address" >
                        <span class="text-danger">{{ $errors->has('mail_from_address') ? $errors->first('mail_from_address') : "" }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="support_email">Support Email</label>
                        <input type="text" class="form-control" name="support_email" value="{{ $mailConfiguration->support_email }}" placeholder="Support Email" >
                        <span class="text-danger">{{ $errors->has('support_email') ? $errors->first('support_email') : "" }}</span>
                      </div>
                    </div>
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