@extends('backend.layouts.app')
@section('content')
<style>
  .custom-width-modal {
    max-width: 800px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 pb-2 pb-sm-0">
          <h1>News List</h1>
        </div>
        <div class="col-sm-6 text-sm-right">
          <a href="{{ url('news/add') }}" class="btn btn-primary">Add New News</a>
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
                    <th>S. No.</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Content Type</th>
                    <th>Featured Image</th>
                    <th>Gallery Images</th>
                    <th>Description</th>
                    <th>Language</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($allNews) > 0)
                  
                  @php($i = 1)
                  @foreach($allNews as $news)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $news->category_name }}</td>
                    <td>
                      {!! str_word_count($news->title, 0) > 8 ? implode(' ', array_slice(str_word_count($news->title, 2), 0, 8)) . '...' : $news->title !!}
                    </td>
                    <td>
                      @if($news->content_type == 1)
                        Standard Post
                      @elseif($news->content_type == 2)
                        Video (YouTube)
                      @elseif($news->content_type == 3)
                        Other URL
                      @elseif($news->content_type == 4)
                        Video
                      @endif
                    </td>
                    <td>
                      <img src="{{ asset($news->featured_image) }}" style="height: 50px; width: 70px;" alt="Flag">
                    </td>
                    <td class="d-flex">
                      @if ($news->gallery_images)
                        @foreach(json_decode($news->gallery_images) as $key => $image)
                          @if ($key < 2)
                            <img src="{{ asset($image) }}" class="gallery-image" data-toggle="modal" data-target="#imageModal" data-src="{{ asset($image) }}" style="height: 50px; width: 70px; margin-right: 5px;" alt="Gallery Image">
                          @endif
                        @endforeach
                      @endif
                    </td>
                    <td>{!! implode(' ', array_slice(str_word_count(strip_tags($news->description), 2), 0, 10)) . '...' !!}</td>
                    <td>{{ $news->language_name }}</td>
                    <td>
                      @if($news->status == 0)
                        <span class="badge badge-success">Active</span>
                      @else
                        <span class="badge badge-secondary">Inactive</span>
                      @endif
                    </td>
                    <td class="">
                      <button class="btn btn-sm btn-info" style="margin: 2px;" onclick="viewNews({{ json_encode($news) }})">View</button>
                      <a href="{{ url('news/edit/'. $news->id) }}" class="btn btn-sm btn-primary" style="margin: 2px;">Edit</a>
                      <a href="{{ url('news/delete/'. $news->id) }}" onclick="return confirm('Are you sure you want to delete this news?')" class="btn btn-sm btn-danger" style="margin: 2px;">Delete</a>
                    </td>
                  </tr>
                  @endforeach

                  @else
                  <tr>
                    <td colspan="10" class="text-center">No data found.</td>
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

<!-- Modal for displaying detailed news information -->
<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-width-modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newsModalLabel">News Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="newsModalBody">
        <!-- News details will be displayed here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// JavaScript function to view news details in the modal
function viewNews(news) {
  // Parse the tags JSON string
  var tags = JSON.parse(news.tags);

  // Parse the gallery images JSON string
  var galleryImages = JSON.parse(news.gallery_images);

  // Create the HTML content for tags
  var tagsHTML = '';
  if (Array.isArray(tags) && tags.length > 0) {
    tagsHTML = '<p><strong>Tags:</strong> ' + tags.join(', ') + '</p>';
  }

  // Create the HTML content for gallery images
  const assetBaseUrl = '{{ asset('') }}';
  var galleryImagesHTML = '';
  if (Array.isArray(galleryImages) && galleryImages.length > 0) {
    galleryImagesHTML = '<p><strong>Gallery Images:</strong><br>';
    galleryImages.forEach(function(imageUrl) {
        galleryImagesHTML += '<img src="' + assetBaseUrl + imageUrl + '" style="height: 70px; width: 100px; margin-right: 5px;" alt="Gallery Image">';
    });
    galleryImagesHTML += '</p>';
    }
    
  var modalBody = $('#newsModalBody');
  modalBody.html(`
    <p><strong>Title:</strong> ${news.title}</p>
    <p><strong>Category:</strong> ${news.category_name}</p>
    <p><strong>Language:</strong> ${news.language_name}</p>
    <p><strong>Description:</strong> ${news.description}</p>
    ${tagsHTML}
    <p><strong>Featured Image:</strong></p>
    <img src="{{ asset('') }}${news.featured_image}" style="height: 70px; width: 100px;" alt="Featured Image">
    ${galleryImagesHTML}
  `);

  // Show the modal
  $('#newsModal').modal('show');
}
</script>
@endsection
