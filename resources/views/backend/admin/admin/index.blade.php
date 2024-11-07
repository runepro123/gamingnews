@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Admin List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('admin/add') }}" class="btn btn-primary">Add New Admin</a>
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
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($admins) > 0)
                  
                  @php($i = 1)
                  @foreach($admins as $admin)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $admin->name }}</td>
                      <td>{{ $admin->email }}</td>
                      <td>{{ date('d-m-Y H:i A', strtotime($admin->created_at)) }}</td>
                      <td>
                        @if($admin->status == 0)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                      </td>
                      <td class="d-flex">
                        @if($admin->email != 'admin@gmail.com')
                          <a href="{{ url('admin/edit/'. $admin->id) }}" class="btn btn-sm btn-primary mr-1">Edit</a>
                          <a href="{{ url('admin/delete/'. $admin->id) }}" onclick="return confirm('Are you sure you want to delete this Admin?')" class="btn btn-sm btn-danger">Delete</a>
                        @endif
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