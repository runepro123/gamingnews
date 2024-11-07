@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Location List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('location/add') }}" class="btn btn-primary">Add New Location</a>
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
              <div class="card-body table-responsive p-3">
                <table id="dataTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Location Name</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($locations) > 0)
                  
                  @php($i = 1)
                  @foreach($locations as $location)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $location->location_name }}</td>
                      <td>{{ $location->latitude }}</td>
                      <td>{{ $location->longitude }}</td>
                      <td class="d-flex">
                        <a href="{{ url('location/edit/'. $location->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        <a href="{{ url('location/delete/'. $location->id) }}" onclick="return confirm('Are you sure you want to delete this location?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="5" class="text-center">No data found.</td>
                    </tr>
                  @endif
                  </tbody>
                </table>
                <div class="d-flex justify-content-center pt-2">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection