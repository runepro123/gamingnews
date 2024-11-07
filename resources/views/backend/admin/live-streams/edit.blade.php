@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Live Stream</h1>
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
              <form action="{{ url('live-stream/edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $liveStream->title) }}" placeholder="Title">
                    <input type="hidden" class="form-control" name="live_stream_id" value="{{ $liveStream->id }}">
                    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Content Type</label>
                    <select name="content_type" id="content_type" class="form-control">
                      <option value="2" @if($liveStream->content_type == '2') selected @endif>Video (YouTube)</option>
                      <option value="3" @if($liveStream->content_type == '3') selected @endif>Video (Other URL)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url" value="{{ old('url', $liveStream->url) }}" placeholder="Type URL">
                    <span class="text-danger">{{ $errors->has('url') ? $errors->first('url') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Language</label>
                    <select name="language_id" class="form-control">
                      @foreach($languages as $language)
                      <option value="{{ $language->id }}"  @if($language->id == $liveStream->language_id) selected @endif>{{ $language->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('language_id') ? $errors->first('language_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" value="{{ old('image') }}" placeholder="Choose an Image">
                    <img src="{{ asset($liveStream->image) }}" style="height: 50px; width: 70px; margin-top: 10px;" alt="Flag">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0" @if($liveStream->status == '0') selected @endif>Active</option>
                      <option value="1" @if($liveStream->status == '1') selected @endif>Inactive</option>
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