@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Location</h1>
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
              <form action="{{ url('location/add') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Location Name</label>
                    <input type="text" class="form-control" name="location_name" value="{{ old('location_name') }}" placeholder="Location Name">
                    <span class="text-danger">{{ $errors->has('location_name') ? $errors->first('location_name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" class="form-control" name="latitude" value="{{ old('latitude') }}" placeholder="Latitude">
                    <span class="text-danger">{{ $errors->has('latitude') ? $errors->first('latitude') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" class="form-control" name="longitude" value="{{ old('longitude') }}" placeholder="Longitude">
                    <span class="text-danger">{{ $errors->has('longitude') ? $errors->first('longitude') : "" }}</span>
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