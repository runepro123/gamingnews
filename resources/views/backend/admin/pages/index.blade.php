@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Page List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('page/add') }}" class="btn btn-primary">Add New Page</a>
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
                      <th>Slug</th>
                      <th>Language</th>
                      <th>Icon</th>
                      <th>Status</th>
                      <th>Operate</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($pages) > 0)
                  
                  @php($i = 1)
                  @foreach($pages as $page)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $page->title }}</td>
                      <td>{{ $page->slug }}</td>
                      <td>{{ $page->language_name }}</td>
                      <td>
                        <img src="{{ asset($page->icon) }}" style="height: 50px; width: 70px;" alt="Icon">
                      </td>
                      <td>
                        @if($page->status == 0)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                      </td>
                      <td class="d-flex">
                        <a href="{{ url('page/edit/'. $page->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                        <a href="{{ url('page/delete/'. $page->id) }}" onclick="return confirm('Are you sure you want to delete this page?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="7" class="text-center">No data found.</td>
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