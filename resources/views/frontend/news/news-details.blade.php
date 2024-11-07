@extends('frontend.layouts.app')
@section('content')
<style>
  #likeIcon {
    cursor: pointer !important;
  }

  #copyUrlButton:hover {
    cursor: pointer;
  }

  .details-top {
    display: flex;
    justify-content: space-between;
    padding: 20px 0;
    border-bottom: 2px solid #5D5D5D;
  }

  .details-top div i {
    color: #5D5D5D;
    font-size: 16px;
    padding-right: 10px;
  }
  .details-top div span {
    color: #5D5D5D;
    font-size: 16px;
    font-weight: bold;
  }
  .title {
    padding: 40px 0;
    border-bottom: 2px solid #5D5D5D;
  }
  .title h2{
    font-size: 50px;
    color: #000;
    font-weight: bold;
  }
  .title span{
    font-size: 100px;
    color: #000;
    font-weight: bold;
  }
  .feature-img {
    padding-top: 30px;
  }
  .blog_details p {
    font-size: 19px;
    color: #000;
    font-weight: normal;
  }
  .single-post-area .navigation-area {
    border: none !important;
  }
  .comment div i {
    color: #5D5D5D;
    font-size: 16px;
    padding-right: 10px;
  }
  .comment div span {
    color: #5D5D5D;
    font-size: 16px;
    font-weight: bold;
  }

  .button-comment {
    border: none;
    color: #555555;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    padding: 10px 40px;
    border-radius: 5px;
  }

  .blog_right_sidebar .search_widget .input-group button {
    background: #E8E8E8 !important;
  }
  .blog_right_sidebar .search_widget .input-group button i {
    color: #000000 !important;
  }

  .related_news .media-body a h3{
    color: #000;
    font-size: 19px;
    font-weight: bold;
  }
  .related_news .media-body {
    padding-left: 20px;
  }
  .related_news .media-body p{
    color: #5D5D5D;
    font-size: 16px;
    font-weight: bold;
  }
  .related_news_title {
    margin-bottom: 0px;
  }

  img, iframe {
    max-width: 100% !important;
  }

  .youtube-video-container {
    position: relative;
    width: 100%;
    height: 450px; 
    margin-top: 20px; 
  }

  .youtube-video-container iframe {
      width: 100%;
      height: 100%;
  }

</style>
<main>
  <!--================Blog Area =================-->
  <section class="blog_area single-post-area section-padding" style="background: #f4f4f4">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 posts-list" style="background: #fff">
          <div class="details-top d-flex">
            <div>
              <i class="fa fa-calendar"></i>
              <span>{{ date('Y-m-d', strtotime($newsDetails->created_at)) }}</span>
            </div>
            <div>
              <i class="fa fa-certificate"></i>
              <span>{{ $newsDetails->category_name }}</span>
            </div>
            <div>
              <i class="fa fa-comment"></i>
              <span>{{ count($comments) }} Comments</span>
            </div>
            <div>
              <i class="fa fa-thumbs-up" id="likeIcon" onclick="incrementFavorite({{ $newsDetails->id }})"></i>
              <span><span id="totalLike">{{ $newsDetails->favorite_count }}</span> Likes</span> 
            </div>
          </div>
          <div class="title">
            <h2><span>{{ ucfirst(explode(' ', $newsDetails->title)[0]) }}</span> {{ substr($newsDetails->title, strlen(explode(' ', $newsDetails->title)[0])) }}</h2>
          </div>

          <div class="single-post">
            @if ($newsDetails->content_type == 1)
              <div class="feature-img">
                <img src="{{ asset($newsDetails->featured_image) }}" class="img-fluid" alt="">
              </div>
            @elseif ($newsDetails->content_type == 2)
              <div class="youtube-video-container mt-4">
                @if ($info && $info->code)
                  <div class="youtube-video-container mt-4">
                    {!! $info->code->html !!}
                  </div>
                @else
                  <p>No video available</p>
                @endif
              </div>
            @elseif ($newsDetails->content_type == 3)
              <video controls class="mt-4 w-100">
                <source src="{{ asset($newsDetails->other_url) }}" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
            @elseif ($newsDetails->content_type == 4)
              <video controls class="mt-4 w-100">
                <source src="{{ asset($newsDetails->video) }}" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
            @endif

            <div class="blog_details">
                <p>{!! $newsDetails->description !!}</p>
            </div>
          </div>
          
          <div class="navigation-top">
            <div class="d-sm-flex justify-content-between text-center">
              <div class="col-sm-4 text-center my-2 my-sm-0">
              </div>
              <ul class="social-icons">
                <li>
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                  <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>
                <li>
                <a id="copyUrlButton" onclick="copyToClipboard('{{ url()->current() }}')" style="color: #5D5D5D;">Share</a>
                </li>
              </ul>
            </div>
            <div class="navigation-area">
              <div class="row">
                <div
                  class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center"
                >
                  @if($prevNews)
                    <div class="thumb">
                      <a href="{{ url('news-details', $prevNews->id) }}">
                        <img
                          class="img-fluid"
                          src="{{ asset($prevNews->featured_image) }}"
                          height="60"
                          width="60"
                          alt=""
                        />
                      </a>
                    </div>
                    <div class="arrow">
                      <a href="{{ url('news-details', $prevNews->id) }}">
                        <span class="lnr text-white ti-arrow-left"></span>
                      </a>
                    </div>
                    <div class="detials">
                      <p>Prev Post</p>
                      <a href="{{ url('news-details', $prevNews->id) }}">
                        <h4>{{ $prevNews->title }}</h4>
                      </a>
                    </div>
                  @else
                    <p>No previous news available.</p>
                  @endif
                </div>
                <div
                  class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center"
                >
                  @if($nextNews)
                    <div class="detials">
                      <p>Next Post</p>
                      <a href="{{ url('news-details', $nextNews->id) }}">
                        <h4>{{ $nextNews->title }}</h4>
                      </a>
                    </div>
                    <div class="arrow">
                      <a href="{{ url('news-details', $nextNews->id) }}">
                        <span class="lnr text-white ti-arrow-right"></span>
                      </a>
                    </div>
                    <div class="thumb">
                      <a href="{{ url('news-details', $nextNews->id) }}">
                        <img
                          class="img-fluid"
                          src="{{ asset($nextNews->featured_image) }}"
                          height="60"
                          width="60"
                          alt=""
                        />
                      </a>
                    </div>
                  @else
                    <p>No next news available.</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="comments-area">
            <div class="comment text-center">
              <i class="fa fa-comment"></i>
              <span>{{ count($comments) }} Comments</span>
            </div>
            @foreach ($comments as $comment)
            <div class="comment-list">
              <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                  <div class="thumb">
                      @if ($comment->user->profile_image)
                        <img src="{{ asset($comment->user->profile_image) }}" alt="User Image" />
                      @else 
                        <img src="{{ asset('frontend') }}/assets/img/comment/profile_image.jpg" alt="" />
                      @endif
                  </div>
                  <div class="desc">
                    <p class="comment">   
                      <div class="d-flex align-items-center">
                        <h5>
                          <a href="#" style="color: #5D5D5D; font-weight: bold;">{{ $comment->user->name ? $comment->user->name : 'Unknown' }}</a>
                        </h5>
                        <p class="date">{{ date('F j, Y \a\t h:i A', strtotime($comment->created_at)) }}</p>
                      </div>
                    </p>
                    <div class="d-flex justify-content-between">
                      <p style="color: #333333; font-weight: normal;">{{ $comment->comment }}</p>
                      <div class="reply-btn">
                        <!-- <a href="#" class="btn-reply text-uppercase">reply</a> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="comment-form">
            <h4>Leave a comment</h4>
            <form class="form-contact comment_form" action="{{ url('/news/save-comment') }}" method="POST" id="commentForm">
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <input type="hidden" name="news_id" value="{{ $newsDetails->id }}">
                    <input type="hidden" name="user_id" value="" id="commentUserId">
                    <textarea
                      class="form-control w-100"
                      name="comment"
                      id="comment"
                      cols="30"
                      rows="5"
                      placeholder="Write Comment"
                    ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group" style="text-align: right;">
                <button
                  onclick="submitComment()"
                  type="button"
                  class="button button-comment"
                >
                  Send
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="blog_right_sidebar">
            <aside class="single_sidebar_widget search_widget" style="background: #fff;">
              <form  action="{{ url('search') }}" method="POST">
                @csrf
                <div class="form-group">
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      class="form-control"
                      name="query"
                      placeholder="Search news....."
                    />
                    <div class="input-group-append">
                      <button class="btns" type="submit">
                        <i class="ti-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </aside>
            <aside class="single_sidebar_widget post_category_widget" style="background: #fff;">
              <h4 class="widget_title">Category</h4>
              <ul class="list cat-list">
                @foreach ($categoriesWithCount as $category)
                  <li>
                    <a href="{{ url('category-news/' . $category->id) }}" class="d-flex">
                      <p>{{ $category->name }}</p>
                      <p>({{ $category->post_count }})</p>
                    </a>
                  </li>
                @endforeach
              </ul>
            </aside>
            <aside class="" style="background: #fff; padding: 30px 30px 10px 30px;">
              <h3 class="widget_title" style="margin-bottom: 0px;">Related News</h3>
            </aside>
            @if(count($relatedNews) > 0)
              @foreach($relatedNews as $news)
                <aside style="background: #fff; padding: 30px; margin-bottom: 10px;">
                  <div class="media post_item related_news">
                    @php
                      $imagePath = asset($news->featured_image);
                    @endphp
                    <a href="{{ url('news-details', $news->id) }}">
                      <img src="{{ $imagePath }}" height="80" width="80" alt="" alt="post" />
                    </a>
                    <div class="media-body">
                      <a href="{{ url('news-details', $news->id) }}">
                        <h3>{{ $news->title }}</h3>
                      </a>
                      <p>{{ date('Y-m-d', strtotime($news->created_at)) }}</p>
                    </div>
                  </div>
                </aside>
              @endforeach
            @else
              <aside style="background: #fff; padding: 30px; margin-bottom: 10px;">
                <div class="media post_item related_news">
                  <p>No related news found for this category.</p>
                </div>
              </aside>
            @endif
            <aside class="single_sidebar_widget tag_cloud_widget" style="background: #fff; margin-top: 30px;">
              <h4 class="widget_title">Tag Clouds</h4>
              <ul class="list">
                @foreach(json_decode($newsDetails->tags) as $tag)
                  <li>
                    <a href="#">{{ $tag }}</a>
                  </li>
                @endforeach
              </ul>
            </aside>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ Blog Area end =================-->
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let userId = localStorage.getItem('user_id');
        document.getElementById('commentUserId').value = userId;
    });

  async function submitComment() {
        let userId = localStorage.getItem('user_id');

        if (userId) {
            let comment = document.getElementById('comment').value;

            if (comment.length === 0) {
              Swal.fire({
                title: 'Oops...',
                text: 'Comment is required!',
              });
              
              return;
            }
            // User is logged in, proceed with comment submission
            document.getElementById('commentForm').submit();
        } else {
            Swal.fire({
              title: 'Login Required',
              text: 'Please log in to leave a comment.',
              icon: 'warning',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = '{{ url("/user-login") }}';
              }
            });
        }
    }
  
  async function incrementFavorite(newsId) {
    try {
      // Send an AJAX request to your Laravel backend
      let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
      // var baseUrl = '{{ config('app.url') }}';
      var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;

      let res = await fetch(baseUrl + "/api/news/increment-favorite", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          news_id: newsId,
        })
      });

      let data = await res.json();

      if (data.status === 'success') {
        // Update the UI to reflect the incremented favorite count
        let totalLikeElement = document.getElementById('totalLike');
        let text = totalLikeElement.innerText;
        let incrementedCount = parseInt(text) + 1;
        totalLikeElement.innerText = incrementedCount;
      } else {
        console.error("Error:", data.message);
      }
    } catch (error) {
      console.error("An error occurred:", error);
    }
  }

  function copyToClipboard(text) {
    var input = document.createElement('input');
    input.value = text;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);

    alert('Link copied!');
  }
</script>
@endsection
