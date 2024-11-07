@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Social Media</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('settings/social-configuration/update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $social->name) }}" placeholder="Name">
                    <input type="hidden" class="form-control" name="social_id" value="{{ $social->id }}">
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Icon</label>
                    <input type="file" class="form-control" name="icon" placeholder="Choose an Icon">
                    <img src="{{ asset($social->icon) }}" style="margin-top: 10px" alt="Icon">
                  </div>
                  <div class="form-group">
                    <label>Link</label>
                    <input type="text" class="form-control" name="link" value="{{ old('link', $social->link) }}" placeholder="Link">
                    <span class="text-danger">{{ $errors->has('link') ? $errors->first('link') : "" }}</span>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection