@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Survey List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="{{ url('add-survey') }}" class="btn btn-primary">Add New Survey</a>
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
                      <th>Question</th>
                      <th>Language</th>
                      <th>Total Votes</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($surveys) > 0)
                  
                  @php($i = 1)
                  @foreach($surveys as $survey)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $survey->question }}</td>
                      <td>{{ $survey->language->name }}</td>
                      <td>{{ $survey->totalVotes() }}</td>
                      <td>
                        @if($survey->status == 0)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Inactive</span>
                        @endif
                      </td>
                      <td class="">
                        <a href="{{ url('view-options/' . $survey->id) }}" class="btn btn-sm btn-info" style="margin: 2px;">View Options</a>
                        <a href="{{ url('edit-survey/' . $survey->id) }}" class="btn btn-sm btn-primary" style="margin: 2px;">Edit</a>
                        <a href="{{ url('delete-survey/'. $survey->id) }}" onclick="return confirm('Are you sure you want to delete this survey?')" class="btn btn-sm btn-danger" style="margin: 2px;">Delete</a>
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