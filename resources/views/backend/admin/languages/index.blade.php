@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Language List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('language/add') }}" class="btn btn-primary">Add New Language</a>
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
                      <th>Display Name</th>
                      <th>Code</th>
                      <th>Flag</th>
                      <th>Is RTL?</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($languages) > 0)
                  
                  @php($i = 1)
                  @foreach($languages as $language)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $language->name }}</td>
                      <td>{{ $language->display_name }}</td>
                      <td>{{ $language->code }}</td>
                      <td>
                        <img src="{{ asset($language->flag) }}" style="height: 50px; width: 70px;" alt="Flag">
                      </td>
                      <td>
                        @if($language->is_rtl == 1)
                          Yes
                        @else
                          NO
                        @endif
                      </td>
                      <td>
                        @if($language->status == 0)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ url('language/edit/'. $language->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{ url('language/delete/'. $language->id) }}" onclick="return confirm('Are you sure you want to delete this language?')" class="btn btn-sm btn-danger">Delete</a>
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