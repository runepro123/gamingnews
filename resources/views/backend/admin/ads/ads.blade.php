@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ads</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @include('backend.message')
          <form action="{{ url('ad/update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label class="card-title">Header Ad</label>              
                  </div>
                  <div class="col-md-6">
                    <h6>Ad Image</h6>
                    <div class="form-group">
                      <input type="file" class="form-control" name="header_ad_img" placeholder="Header Ad" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <h6>Link</h6>
                      <input type="text" class="form-control" name="header_ad_link" value="{{ $ads->header_ad_link }}" placeholder="Link" >
                      <span class="text-danger">{{ $errors->has('header_ad_link') ? $errors->first('header_ad_link') : "" }}</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <img src="{{ asset($ads->header_ad_img) }}" class="img-fluid" alt="">         
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label class="card-title">Banner Ad <span style="color: red; font-weight: normal">[Ad Space: Home Page]</span></label>              
                  </div>
                  <div class="col-md-6">
                    <h6>Ad Image</h6>
                    <div class="form-group">
                      <input type="file" class="form-control" name="banner_ad_img" placeholder="Banner Ad" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <h6>Link</h6>
                      <input type="text" class="form-control" name="banner_ad_link" value="{{ $ads->banner_ad_link }}" placeholder="Link" >
                      <span class="text-danger">{{ $errors->has('banner_ad_link') ? $errors->first('banner_ad_link') : "" }}</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <img src="{{ asset($ads->banner_ad_img) }}" class="img-fluid" alt="">         
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label class="card-title">Card Ad <span style="color: red; font-weight: normal">[Ad Space: Home Page]</span></label>              
                  </div>
                  <div class="col-md-6">
                    <h6>Ad Image</h6>
                    <div class="form-group">
                      <input type="file" class="form-control" name="card_ad_img" placeholder="Card Ad" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <h6>Link</h6>
                      <input type="text" class="form-control" name="card_ad_link" value="{{ $ads->card_ad_link }}" placeholder="Link" >
                      <span class="text-danger">{{ $errors->has('card_ad_link') ? $errors->first('card_ad_link') : "" }}</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <img src="{{ asset($ads->card_ad_img) }}" class="img-fluid" alt="">         
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label class="card-title">Sidebar Ad <span style="color: red; font-weight: normal">[Ad Space: Category and Latest News Page]</span></label>              
                  </div>
                  <div class="col-md-6">
                    <h6>Ad Image</h6>
                    <div class="form-group">
                      <input type="file" class="form-control" name="sidebar_ad_img" placeholder="Sidebar Ad" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <h6>Link</h6>
                      <input type="text" class="form-control" name="sidebar_ad_link" value="{{ $ads->sidebar_ad_link }}" placeholder="Link" >
                      <span class="text-danger">{{ $errors->has('sidebar_ad_link') ? $errors->first('sidebar_ad_link') : "" }}</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <img src="{{ asset($ads->sidebar_ad_img) }}" class="img-fluid" alt="">         
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label class="card-title">Footer Top Ad</label>              
                  </div>
                  <div class="col-md-6">
                    <h6>Ad Image</h6>
                    <div class="form-group">
                      <input type="file" class="form-control" name="footer_top_ad_img" placeholder="Footer Top Ad" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <h6>Link</h6>
                      <input type="text" class="form-control" name="footer_top_ad_link" value="{{ $ads->footer_top_ad_link }}" placeholder="Link" >
                      <span class="text-danger">{{ $errors->has('footer_top_ad_link') ? $errors->first('footer_top_ad_link') : "" }}</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <img src="{{ asset($ads->footer_top_ad_img) }}" class="img-fluid" alt="">         
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <label class="card-title">Footer Ad</label>              
                  </div>
                  <div class="col-md-6">
                    <h6>Ad Image</h6>
                    <div class="form-group">
                      <input type="file" class="form-control" name="footer_ad_img" placeholder="Footer Ad" >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <h6>Link</h6>
                      <input type="text" class="form-control" name="footer_ad_link" value="{{ $ads->footer_ad_link }}" placeholder="Link" >
                      <span class="text-danger">{{ $errors->has('footer_ad_link') ? $errors->first('footer_ad_link') : "" }}</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <img src="{{ asset($ads->footer_ad_img) }}" class="img-fluid" alt="">         
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection