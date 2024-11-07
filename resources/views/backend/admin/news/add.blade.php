@extends('backend.layouts.app')
@section('content')
  <style>
      .ck-editor__editable {
          height: 200px !important;
      }

      .select2-container--default .select2-selection--multiple .select2-selection__choice {
        /* background: red !important; */
      }

      .select2-container .select2-search--inline .select2-search__field {
        border: none  !important;
        padding: 0  !important;
      }

      .select2-container {
        width: 100% !important;
      }
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New News</h1>
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
              <form action="{{ url('news/add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Language</label>
                    <select name="language_id" id="language_id" class="form-control">
                      <option selected disabled>Select Language</option>
                      @foreach($languages as $language)
                      <option value="{{ $language->id }}">{{ $language->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('language_id') ? $errors->first('language_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                      <option selected disabled>Select Category</option>
                      @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('category_id') ? $errors->first('category_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Tag</label>
                    <select name="tags[]" id="tags" class="news-tags form-control" multiple="multiple">
                      @foreach($tags as $tag)
                      <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('tags') ? $errors->first('tags') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Location</label>
                    <select name="location_id" class="form-control">
                      <option selected disabled>Select Location</option>
                      @foreach($locations as $location)
                      <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('location_id') ? $errors->first('location_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Content Type</label>
                    <select name="content_type" id="content_type" class="form-control">
                      <option selected value="1">Standard Post</option>
                      <option value="2">Video (YouTube)</option>
                      <option value="3">Video (Other URL)</option>
                      <option value="4">Video (Upload)</option>
                    </select>
                  </div>
                  <div class="" id="youTubeUrlField" style="display: none;">
                    <div class="form-group">
                    <label>YouTube URL</label>
                    <input type="text" class="form-control" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="YouTube URL">
                    <span class="text-danger">{{ $errors->has('youtube_url') ? $errors->first('youtube_url') : "" }}</span>
                    </div>
                  </div>
                  <div class="form-group" id="otherUrlField" style="display: none;">
                    <label>Other URL</label>
                    <input type="text" class="form-control" name="other_url" value="{{ old('other_url') }}" placeholder="Other URL">
                    <span class="text-danger">{{ $errors->has('other_url') ? $errors->first('other_url') : "" }}</span>
                  </div>
                  <div class="form-group" id="videoField" style="display: none;">
                    <label>Upload Video</label>
                    <input type="file" class="form-control" name="video" value="{{ old('video') }}" placeholder="Upload Video">
                    <span class="text-danger">{{ $errors->has('video') ? $errors->first('video') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Featured Image</label>
                    <input type="file" class="form-control" name="featured_image" value="{{ old('featured_image') }}">
                    <span class="text-danger">{{ $errors->has('featured_image') ? $errors->first('featured_image') : "" }}</span>
                  </div>
                  <div class="form-group">
                      <label>Gallery Images</label>
                      <input type="file" class="form-control" name="gallery_images[]" multiple accept="image/*" value="{{ old('gallery_images') }}">
                      <span class="text-danger">{{ $errors->has('gallery_images') ? $errors->first('gallery_images') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea id="editor" name="description"  class="form-control">{{ old('description') }}</textarea>
                    <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Show Till (Expiry Date)</label>
                    <input type="date" class="form-control" name="show_till" value="{{ old('show_till') }}">
                    <span class="text-danger">{{ $errors->has('show_till') ? $errors->first('show_till') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="notify_users" id="notify_users" value="1">
                      <label class="form-check-label" for="notify_users">Notify Users?</label>
                    </div>
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
  // var baseUrl = '{{ config('app.url') }}';
  var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}';

  // Get Categories and Tags By Language
  document.getElementById('language_id').addEventListener('change', function () {
      var languageId = this.value;
      var categoryDropdown = document.getElementById('category_id');
      var tagDropdown = document.getElementById('tags');

      // Check if a language is selected
      if (languageId) {
        // Get Categories
        var categoriesUrl = baseUrl + '/categories/' + languageId;
        fetch(categoriesUrl)
            .then(response => response.json())
            .then(categories => {
              // Clear existing options
              categoryDropdown.innerHTML = '<option selected disabled>Select Category</option>';

              // Add new options based on the response
              categories.forEach(category => {
                var option = document.createElement('option');
                option.value = category.id;
                option.text = category.name;
                categoryDropdown.appendChild(option);
              });
            })
            .catch(error => console.error(error));

        // Get Tags
        var tagsUrl = baseUrl + '/tags/' + languageId;
        fetch(tagsUrl)
            .then(response => response.json())
            .then(tags => {
              // Clear existing options
              tagDropdown.innerHTML = '';

              // Add new options based on the response
              tags.forEach(tag => {
                var option = document.createElement('option');
                option.value = tag.name;
                option.text = tag.name;
                tagDropdown.appendChild(option);
              });
            })
            .catch(error => console.error(error));
      }

  });
</script>


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
  </script>

<script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
  var editor = CKEDITOR.replace( 'description' , {
    customConfig: "{{ asset('backend/plugins/ckeditor/config.js') }}",
    removeButtons: 'Image',
    allowedContent: true,
  });
</script>
@endsection