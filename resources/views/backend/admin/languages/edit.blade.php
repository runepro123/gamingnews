@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Language</h1>
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
              <form action="{{ url('language/edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Language Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $language->name) }}" placeholder="Name">
                    <input type="hidden" class="form-control" name="language_id" value="{{ $language->id }}">
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Display Name (Display in app/web)</label>
                    <input type="text" class="form-control" name="display_name" value="{{ old('display_name', $language->display_name) }}" placeholder="Display Name">
                    <span class="text-danger">{{ $errors->has('display_name') ? $errors->first('display_name') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Code</label>
                    <input type="text" class="form-control" name="code" value="{{ old('code', $language->code) }}" placeholder="Code">
                    <span class="text-danger">{{ $errors->has('code') ? $errors->first('code') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Flag</label>
                    <input type="file" class="form-control" name="flag" value="" placeholder="Choose Flag Image">
                    <img src="{{ asset($language->flag) }}" style="height: 50px; width: 70px; margin-top: 10px;" alt="Flag">
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_rtl" id="is_rtl" value="1" {{ $language->is_rtl == 1 ? 'checked' : '' }}>
                      <label class="form-check-label" for="is_rtl">Is RTL?</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0" @if($language->status == '0') selected @endif>Active</option>
                      <option value="1" @if($language->status == '1') selected @endif>Inactive</option>
                    </select>
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