@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Web Configuration</h1>
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
              <form action="{{ url('settings/web-configuration/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="frontend_api_base_url">Frontend API Base URL</label>
                        <input type="text" class="form-control" name="frontend_api_base_url" id="frontend_api_base_url" value="{{ $webConfiguration->frontend_api_base_url }}" placeholder="Frontend API Base URL" >
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="frontend_api_base_url">Web App Name</label>
                        <input type="text" class="form-control" name="web_app_name" id="web_app_name" value="{{ $webConfiguration->web_app_name }}" placeholder="Web App Name" >
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="nav_text_color">Navbar Text Color</label>
                        <input type="color" class="form-control" name="nav_text_color" id="nav_text_color" value="{{ $webConfiguration->nav_text_color }}" placeholder="Select Color" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="color">Navbar Background Color</label>
                        <input type="color" class="form-control" name="color" id="color" value="{{ $webConfiguration->color }}" placeholder="Select Color" >
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Header Logo</label>
                          <input type="file" class="form-control" name="header_logo" id="header_logo" placeholder="Header Logo" >
                          <img src="{{ asset($webConfiguration->header_logo) }}" style="margin-top: 10px;" width="80" alt="Header Logo">
                        </div>
                        <div class="form-group">
                          <label>Header Top Contact</label>
                          <input type="text" class="form-control" name="header_contact" id="header_contact" value="{{ $webConfiguration->header_contact }}" placeholder="Header Top Contact" >
                          <span class="text-danger">{{ $errors->has('header_contact') ? $errors->first('header_contact') : "" }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Footer Logo</label>
                          <input type="file" class="form-control" name="footer_logo" id="footer_logo" placeholder="Footer Logo" >
                           <img src="{{ asset($webConfiguration->footer_logo) }}" style="margin-top: 10px;" width="80" alt="Footer Logo">
                        </div>
                        <div class="form-group">
                          <label>Footer Contact</label>
                          <input type="text" class="form-control" name="footer_contact" id="footer_contact" value="{{ $webConfiguration->footer_contact }}" placeholder="Footer Contact" >
                          <span class="text-danger">{{ $errors->has('footer_contact') ? $errors->first('footer_contact') : "" }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label>Google Play App Logo</label>
                      <input type="file" class="form-control" name="google_play_app_logo" id="google_play_app_logo" placeholder="Google Play App Logo" >
                      <img src="{{ asset($webConfiguration->google_play_app_logo) }}" style="margin-top: 10px;" width="150" alt="Google Play App Logo">
                      <span class="text-danger">{{ $errors->has('google_play_app_logo') ? $errors->first('google_play_app_logo') : "" }}</span>
                    </div>
                    <div class="col-md-6 form-group">
                      <label>Google Play App Link</label>
                      <input type="text" class="form-control" name="google_play_app_link" id="google_play_app_link" value="{{ $webConfiguration->google_play_app_link }}" placeholder="Google Play App Link" >
                      <span class="text-danger">{{ $errors->has('google_play_app_link') ? $errors->first('google_play_app_link') : "" }}</span>
                    </div>
                    <div class="col-md-6 form-group">
                      <label>App Store Logo</label>
                      <input type="file" class="form-control" name="app_store_logo" id="app_store_logo" placeholder="App Store Logo" >
                      <img src="{{ asset($webConfiguration->app_store_logo) }}" style="margin-top: 10px;" width="150" alt="App Store Logo">
                      <span class="text-danger">{{ $errors->has('app_store_logo') ? $errors->first('app_store_logo') : "" }}</span>
                    </div>
                    <div class="col-md-6 form-group">
                      <label>App Store Link</label>
                       <input type="text" class="form-control" name="app_store_link" id="app_store_link" value="{{ $webConfiguration->app_store_link }}" placeholder="App Store Link" >
                      <span class="text-danger">{{ $errors->has('app_store_link') ? $errors->first('app_store_link') : "" }}</span>
                    </div>
                    <div class="col-md-12 form-group">
                      <label>Footer Description</label>
                      <textarea name="footer_description" class="form-control" placeholder="Footer Description">{{ $webConfiguration->footer_description }}</textarea>
                      <span class="text-danger">{{ $errors->has('footer_description') ? $errors->first('footer_description') : "" }}</span>
                    </div>
                    <div class="col-md-12 form-group">
                      <label>Footer Address</label>
                      <input type="text" class="form-control" name="footer_address" id="footer_address" value="{{ $webConfiguration->footer_address }}" placeholder="Footer Address" >
                      <span class="text-danger">{{ $errors->has('footer_address') ? $errors->first('footer_address') : "" }}</span>
                    </div>
                    <div class="col-md-12 form-group">
                      <label>Footer Copyright</label>
                      <input type="text" class="form-control" name="copyright" id="copyright" value="{{ $webConfiguration->copyright }}" placeholder="Footer Copyright" >
                      <span class="text-danger">{{ $errors->has('copyright') ? $errors->first('copyright') : "" }}</span>
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