@extends('backend.layouts.app')
@section('content')
  <style>
      .ck-editor__editable {
          height: 200px !important;
      }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Settings</h1>
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
              <form action="{{ url('settings/general/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="app_version">App Version</label>
                    <input type="text" class="form-control" id="app_version" name="app_version" value="{{$generalSettings->app_version}}" placeholder="App Version">
                  </div>    
                  <div class="form-group">
                    <label for="one_single">One Single</label>
                    <input type="text" class="form-control" id="one_single" name="one_single" value="{{$generalSettings->one_single}}" placeholder="One Single">
                  </div>    
                  <div class="form-group">
                    <label for="about_us_url">About Us Url</label>
                    <input type="text" class="form-control" id="about_us_url" name="about_us_url" value="{{$generalSettings->about_us_url}}" placeholder="About Us Url">
                  </div>
                  <div class="form-group">
                    <label for="about_us_url">Contact Us Url</label> 
                    <input type="text" class="form-control" id="contact_us_url" name="contact_us_url" value="{{$generalSettings->contact_us_url}}" placeholder="Contact Us Url">
                  </div>
                  <div class="form-group">
                    <label for="privacy_policy_url">Privacy Policy Url</label>
                    <input type="text" class="form-control" id="privacy_policy_url" name="privacy_policy_url" value="{{$generalSettings->privacy_policy_url}}" placeholder="Privacy Policy Url">
                  </div>
                  <div class="form-group">
                    <label for="terms_and_condition_url">Terms & Conditions Url</label>
                    <input type="text" class="form-control" id="terms_and_condition_url" name="terms_and_condition_url" value="{{$generalSettings->terms_and_condition_url}}" placeholder="Terms & Conditions Url">
                  </div>
                  <div class="form-group">
                    <label for="about_us_url">Rate Us Url</label>
                    <input type="text" class="form-control" id="rate_us_url" name="rate_us_url" value="{{$generalSettings->rate_us_url}}" placeholder="Rate Us Url">
                  </div>
                  <div class="form-group" style="display: none;">
                    <label>Privacy & Policy</label>
                    <textarea id="privacy_policy" name="privacy_policy"  class="form-control">{{$generalSettings->privacy_policy}}</textarea>
                  </div>
                </div> 
                <div class="card-footer">
                  <button type="submit"  class="btn btn-primary">Update</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
      .create( document.querySelector( '#privacy_policy' ) ,
          {
              toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
              autoGrow: true,
              autoGrow_minHeight: 300, // Set the minimum height
              autoGrow_bottomSpace: 10 // Set the bottom space
          })
      .catch( error => {
        console.error( error );
      } );
  </script>
@endsection