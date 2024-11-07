@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Tag</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('tag/add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Language</label>
                    <select name="language_id" class="form-control">
                      <option selected disabled>Select Language</option>
                      @foreach($languages as $language)
                      <option value="{{ $language->id }}">{{ $language->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('language_id') ? $errors->first('language_id') : "" }}</span>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection