@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Slider List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('slider/add') }}" class="btn btn-primary">Add New Slider</a>
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
                      <th>Category</th>
                      <th>Title</th>
                      <th>Content Type</th>
                      <th>Image</th>
                      <th>Description</th>
                      <th>Language</th>
                      <th>Views</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($sliders) > 0)
                  
                  @php($i = 1)
                  @foreach($sliders as $slider)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $slider->category_name }}</td>
                      <td>
                          {!! str_word_count($slider->title, 0) > 8 ? implode(' ', array_slice(str_word_count($slider->title, 2), 0, 8)) . '...' : $slider->title !!}
                      </td>
                      <td>
                        @if($slider->content_type == 1)
                            Standard Post
                        @elseif($slider->content_type == 2)
                            Video (YouTube)
                        @elseif($slider->content_type == 3)
                            Other URL
                        @elseif($slider->content_type == 4)
                            Video
                        @endif
                      </td>
                      <td>
                        <img src="{{ asset($slider->image) }}" style="height: 50px; width: 70px;" alt="Flag">
                      </td>
                      <td>{!! implode(' ', array_slice(str_word_count(strip_tags($slider->description), 2), 0, 10)) . '...' !!}</td>
                      <td>{{ $slider->language_name }}</td>
                      <td>{{ $slider->total_views }}</td>
                      <td>
                        @if($slider->status == 0)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                      </td>
                      <td class="d-flex">
                        <a href="{{ url('slider/edit/'. $slider->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        <a href="{{ url('slider/delete/'. $slider->id) }}" onclick="return confirm('Are you sure you want to delete this slider?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach

                  @else
                    <tr>
                      <td colspan="10" class="text-center">No data found.</td>
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