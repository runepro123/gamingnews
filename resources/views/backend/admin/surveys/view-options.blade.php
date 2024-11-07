@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Survey Option List</h1>
          </div>
          <div class="col-sm-6 text-sm-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addOptionModal">Add New Option</button>
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
                      <th>Option</th>
                      <th>Votes</th>
                      <th>Percentage</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($options) > 0)
                  
                  @php($i = 1)
                  @foreach($options as $option)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $option->option }}</td>
                      <td>{{ $option->counter }}</td>
                      <td>
                        @if ($survey->options->sum('counter') > 0)
                            {{ number_format($option->counter / $survey->options->sum('counter') * 100, 2) }}%
                        @else
                            0
                        @endif
                      </td>
                      <td class="">
                        <button class="btn btn-sm btn-primary" style="margin: 2px;" data-toggle="modal" data-target="#editOptionModal{{ $option->id }}">Edit</button>
                        <a href="{{ url('delete-option/'. $option->id) }}" onclick="return confirm('Are you sure you want to delete this option?')" class="btn btn-sm btn-danger" style="margin: 2px;">Delete</a>
                      </td>
                    </tr>
                    <!-- Edit Option Modal -->
                    <div class="modal fade" id="editOptionModal{{ $option->id }}" tabindex="-1" role="dialog" aria-labelledby="editOptionModalLabel{{ $option->id }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editOptionModalLabel{{ $option->id }}">Edit Option</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ url('update-option/' . $option->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label>Option</label>
                                <input type="text" class="form-control" name="option" value="{{ $option->option }}" placeholder="Enter Option">
                                @error('option')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <button type="submit" class="btn btn-primary">Update Option</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
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

  <!-- Add Option Modal -->
  <div class="modal fade" id="addOptionModal" tabindex="-1" role="dialog" aria-labelledby="addOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addOptionModalLabel">Add New Option</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('add-option/' . $survey->id) }}" method="post">
            @csrf
            <div class="form-group">
              <label>Option</label>
              <input type="text" class="form-control" name="option" placeholder="Enter Option">
              @error('option')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Option</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection