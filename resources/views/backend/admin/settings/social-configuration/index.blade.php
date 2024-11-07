@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Social Media List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('settings/social-configuration/add') }}" class="btn btn-primary">Add New Social Media</a>
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
                      <th>Name</th>
                      <th>Icon</th>
                      <th>Link</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($socials) > 0)
                  
                  @php($i = 1)
                  @foreach($socials as $social)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $social->name }}</td>
                      <td>
                        <img src="{{ asset($social->icon) }}" alt="Flag">
                      </td>
                      <td>{{ $social->link }}</td>
                      <td class="d-flex">
                        <a href="{{ url('settings/social-configuration/edit/'. $social->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        <a href="{{ url('settings/social-configuration/delete/'. $social->id) }}" onclick="return confirm('Are you sure you want to delete this social media?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="6" class="text-center">No data found.</td>
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