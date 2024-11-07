@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Breaking News List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('breaking-news/add') }}" class="btn btn-primary">Add New Breaking News</a>
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
                      <th>Views</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  @if(count($breakingNewsList) > 0)
                  
                  @php($i = 1)
                  @foreach($breakingNewsList as $breakingNews)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>
                        {!! str_word_count($breakingNews->news->title, 0) > 8 ? implode(' ', array_slice(str_word_count($breakingNews->news->title, 2), 0, 12)) . '...' : $breakingNews->news->title !!}
                      </td>
                      <td>
                        <img src="{{ asset($breakingNews->news->featured_image) }}" style="height: 50px; width: 70px;" alt="Flag">
                      </td>
                      <td>{{ $breakingNews->news->total_views }}</td>
                      <td>
                        @if($breakingNews->news->status == 0)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                      </td>
                      <td class="d-flex">
                        <!-- <a href="{{ url('breaking-news/edit/'. $breakingNews->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a> -->
                        <a href="{{ url('breaking-news/delete/'. $breakingNews->id) }}" onclick="return confirm('Are you sure you want to delete this breaking news?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach

                  @else
                    <tr>
                      <td colspan="9" class="text-center">No data found.</td>
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