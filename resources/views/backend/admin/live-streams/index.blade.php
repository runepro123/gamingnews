@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Live Stream List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('live-stream/add') }}" class="btn btn-primary">Add New Live Stream</a>
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
                      <th>Title</th>
                      <th>Image</th>
                      <th>Content Type</th>
                      <th>URL</th>
                      <th>Language</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($liveStreams) > 0)
                  
                  @php($i = 1)
                  @foreach($liveStreams as $liveStream)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $liveStream->title }}</td>
                      <td>
                        <img src="{{ asset($liveStream->image) }}" style="height: 50px; width: 70px;" alt="Flag">
                      </td>
                      <td>
                        @if($liveStream->content_type == 2)
                            Video (YouTube)
                        @elseif($liveStream->content_type == 3)
                            Other URL
                        @endif
                      </td>
                      <td>{{ $liveStream->url }}</td>
                      <td>{{ $liveStream->language_name }}</td>
                      <td>
                        @if($liveStream->status == 0)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                      </td>
                      <td class="d-flex">
                        <a href="{{ url('live-stream/edit/'. $liveStream->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        <a href="{{ url('live-stream/delete/'. $liveStream->id) }}" onclick="return confirm('Are you sure you want to delete this live stream?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="8" class="text-center">No data found.</td>
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