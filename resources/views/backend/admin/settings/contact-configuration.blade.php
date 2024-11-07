@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact Configuration</h1>
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
              <form action="{{ url('settings/contact-configuration/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" name="address" id="address" value="{{ $contactConfiguration->address }}" placeholder="Address" >
                          <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : "" }}</span>
                        </div>
                        <div class="form-group">
                          <label>Contact Number</label>
                          <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ $contactConfiguration->contact_number }}" placeholder="Contact Number" >
                          <span class="text-danger">{{ $errors->has('contact_number') ? $errors->first('contact_number') : "" }}</span>
                        </div>
                        <div class="form-group">
                          <label>Support Email</label>
                          <input type="text" class="form-control" name="support_email" id="support_email" value="{{ $contactConfiguration->support_email }}" placeholder="Support Email" >
                          <span class="text-danger">{{ $errors->has('support_email') ? $errors->first('support_email') : "" }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>House No</label>
                          <input type="text" class="form-control" name="house_no" id="house_no" value="{{ $contactConfiguration->house_no }}" placeholder="House No" >
                          <span class="text-danger">{{ $errors->has('house_no') ? $errors->first('house_no') : "" }}</span>
                        </div>
                        <div class="form-group">
                          <label>Contact Schedule</label>
                          <input type="text" class="form-control" name="contact_schedule" id="contact_schedule" value="{{ $contactConfiguration->contact_schedule }}" placeholder="Contact Schedule" >
                          <span class="text-danger">{{ $errors->has('contact_schedule') ? $errors->first('contact_schedule') : "" }}</span>
                        </div>
                        <div class="form-group">
                          <label>Support Message</label>
                          <input type="text" class="form-control" name="support_message" id="support_message" value="{{ $contactConfiguration->support_message }}" placeholder="Support Message" >
                          <span class="text-danger">{{ $errors->has('support_message') ? $errors->first('support_message') : "" }}</span>
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