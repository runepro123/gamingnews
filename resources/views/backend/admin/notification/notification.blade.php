@extends('backend.layouts.app')
@section('content')
  <style>
      .ck-editor__editable {
          height: 200px !important;
      }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notification</h1>
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
              <form action="{{ url('notification/send') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Message</label>
                    <textarea id="editor" name="message"  class="form-control"></textarea>
                    <span class="text-danger">{{ $errors->has('message') ? $errors->first('message') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url" value="{{ old('url') }}" placeholder="URL">
                  </div>
                  <div class="form-group">
                    <label>Image URL</label>
                    <input type="text" class="form-control" name="image_url" value="{{ old('image_url') }}" placeholder="Image URL">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Send Notification</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
      .create( document.querySelector( '#editor' ) ,
          {
              toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
              autoGrow: true,
              autoGrow_minHeight: 300, // Set the minimum height
              autoGrow_bottomSpace: 10 // Set the bottom space
          })
      .catch( error => {
        console.error( error );
      } );
  </script>
@endsection