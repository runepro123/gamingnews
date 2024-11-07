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
            <h1>Edit Reel</h1>
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
              <form action="{{ url('reel/edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $reel->title) }}" placeholder="Title">
                    <input type="hidden" class="form-control" name="reel_id" value="{{ $reel->id }}">
                    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Content Type</label>
                    <select name="content_type" id="content_type" class="form-control">
                      <!-- <option value="2" @if($reel && $reel->content_type == '2') selected @endif>Video (YouTube)</option> -->
                      <option value="3" @if($reel && $reel->content_type == '3') selected @endif>Video (Other URL)</option>
                      <option value="4" @if($reel && $reel->content_type == '4') selected @endif>Video (Upload)</option>
                    </select>
                  </div>
                  <div class="" id="youTubeUrlField" style="display: none;">
                    <div class="form-group">
                    <label>YouTube URL</label>
                    <input type="text" class="form-control" name="youtube_url" value="{{ old('youtube_url', $reel->youtube_url) }}" placeholder="YouTube URL">
                    <span class="text-danger">{{ $errors->has('youtube_url') ? $errors->first('youtube_url') : "" }}</span>
                    </div>
                  </div>
                  <div class="form-group" id="otherUrlField" style="display: none;">
                    <label>Other URL</label>
                    <input type="text" class="form-control" name="other_url" value="{{ old('other_url', $reel->other_url) }}" placeholder="Other URL">
                    <span class="text-danger">{{ $errors->has('other_url') ? $errors->first('other_url') : "" }}</span>
                  </div>
                  <div class="form-group" id="videoField" style="display: none;">
                    <label>Upload Video</label>
                    <input type="file" class="form-control" name="video" value="" placeholder="Upload Video">
                    @if(!empty($reel->video))
                        <video width="480" height="240" controls style="margin-top: 10px;">
                            <source src="{{ asset($reel->video) }}" type="video/mp4">
                            <source src="{{ asset($reel->video) }}" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Language</label>
                    <select name="language_id" class="form-control">
                      @foreach($languages as $language)
                      <option value="{{ $language->id }}" @if($language->id == $reel->language_id) selected @endif>{{ $language->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" value="" placeholder="Choose an Image">
                    <img src="{{ asset($reel->image) }}" style="height: 50px; width: 70px; margin-top: 10px;" alt="Image">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea id="editor" name="description"  class="form-control">
                      {{ old('title', $reel->description) }}
                    </textarea>
                    <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0" @if($reel->status == '0') selected @endif>Active</option>
                      <option value="1" @if($reel->status == '1') selected @endif>Inactive</option>
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

  <script>
    document.getElementById('content_type').addEventListener('change', function () {
        var youTubeUrlField = document.getElementById('youTubeUrlField');
        var otherUrlField = document.getElementById('otherUrlField');
        var videoField = document.getElementById('videoField');

        if (this.value === '2') {
          youTubeUrlField.style.display = 'block';
          otherUrlField.style.display = 'none';
          videoField.style.display = 'none';
        } else if (this.value === '3') {
          youTubeUrlField.style.display = 'none';
          otherUrlField.style.display = 'block';
          videoField.style.display = 'none';
        }else if (this.value === '4') {
          youTubeUrlField.style.display = 'none';
          otherUrlField.style.display = 'none';
          videoField.style.display = 'block';
        }else {
          youTubeUrlField.style.display = 'none';
          otherUrlField.style.display = 'none';
          videoField.style.display = 'none';
        }
    });

    // Initially show the fields based on the selected type
    var initialType = document.getElementById('content_type').value;
    var youTubeUrlField = document.getElementById('youTubeUrlField');
    var otherUrlField = document.getElementById('otherUrlField');
    var videoField = document.getElementById('videoField');

    if (initialType === '1') {
      youTubeUrlField.style.display = 'none';
      otherUrlField.style.display = 'none';
      videoField.style.display = 'none';
    } else if (initialType === '2') {
      youTubeUrlField.style.display = 'block';
      otherUrlField.style.display = 'none';
      videoField.style.display = 'none';
    }
    else if (initialType === '3') {
      youTubeUrlField.style.display = 'none';
      otherUrlField.style.display = 'block';
      videoField.style.display = 'none';
    } 
    else if (initialType === '4') {
      youTubeUrlField.style.display = 'none';
      otherUrlField.style.display = 'none';
      videoField.style.display = 'block';
    }  
    else {
      youTubeUrlField.style.display = 'none';
      otherUrlField.style.display = 'none';
      videoField.style.display = 'none';
    }
  </script>

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