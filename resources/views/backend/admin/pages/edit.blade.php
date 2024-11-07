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
            <h1>Edit Page</h1>
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
              <form action="{{ url('page/edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="page_id" value="{{ $page->id }}">
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $page->title) }}" placeholder="Title">
                    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug', $page->slug) }}" placeholder="Slug">
                    <span class="text-danger">{{ $errors->has('slug') ? $errors->first('slug') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Meta Description</label>
                    <input type="text" class="form-control" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" placeholder="Meta Description">
                    <span class="text-danger">{{ $errors->has('meta_description') ? $errors->first('meta_description') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Meta Keywords</label>
                    <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" placeholder="Meta Keywords">
                    <span class="text-danger">{{ $errors->has('meta_keywords') ? $errors->first('meta_keywords') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Language</label>
                    <select name="language_id" id="language_id" class="form-control">
                      <option selected disabled>Select Language</option>
                      @foreach($languages as $language)
                      <option value="{{ $language->id }}" @if($language->id == $page->language_id) selected @endif>{{ $language->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('language_id') ? $errors->first('language_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Page Icon</label>
                    <input type="file" class="form-control" name="icon" value="" placeholder="Choose an Icon">
                    <img src="{{ asset($page->icon) }}" style="height: 50px; width: 70px; margin-top: 10px;" alt="Icon">
                    <span class="text-danger">{{ $errors->has('icon') ? $errors->first('icon') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Page Content</label>
                    <textarea id="editor" name="page_content"  class="form-control">{{ old('page_content', $page->page_content) }}</textarea>
                    <span class="text-danger">{{ $errors->has('page_content') ? $errors->first('page_content') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0" @if($page->status == '0') selected @endif>Active</option>
                      <option value="1" @if($page->status == '1') selected @endif>Inactive</option>
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