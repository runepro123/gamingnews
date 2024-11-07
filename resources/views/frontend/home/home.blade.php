@extends('frontend.layouts.app')
@section('content')
<style>
.nav-link.active-category {
  color: red !important;
}

.read-more {
  color: #007bff; 
  text-decoration: none;
  margin-top: 5px;
  display: inline-block;
}
.read-more:hover {
    color: red; 
}

.video-items {
  opacity: 1 !important;
}

.single-video.active-selected-video video {
  border: 2px solid red;
}

.btn-vote {
  background: #428bca;
  padding: 18px 20px;
}

.whats-news-wrapper .section-tittle span {
  color: #555555;
  font-size: 18px !important;
  font-weight: bold;
}
.whates-caption.whates-caption2 h4 a {
  font-size: 18px !important;
}
.whates-caption.whates-caption2 h4 a .first-word-big {
  font-size: 35px ;
  color: #000000;
}
.whats-news-area .whats-news-single .whates-caption span {
 display: inline;
}
.about-area2 .whats-news-single .whates-caption p {
    color: #333333 !important;
     padding-bottom: 10px;
}
.whates-caption.whates-caption2 .date ,
.whates-caption.whates-caption2 .category_name {
    color: #5D5D5D !important;
    font-size: 18px !important;
    font-weight: bold;
}
.whates-caption.whates-caption2  .footer_des {
    border-top: 2px solid #5D5D5D !important;
    padding-top: 10px;
}

/* Main Slider CSS Start */
.btn-wrap {
  text-align: center;
  width: 100%;
}
button {
  background-color: #fff;
  color: #000;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  margin: 10px;
  font-size: 16px;
  font-weight: 600;
  transition: all 0.5s;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.owl-theme .owl-nav .disabled,
button.disabled {
  opacity: 0.6;
}
.slider .whates-caption.whates-caption2 h4 a {
  font-size: 18px !important;
  font-weight: bold;
  padding-top: 20px;
}
.slider .whates-caption.whates-caption2 h4 a:hover {
  color: red;
}
.whates-caption.whates-caption2  .slider_header_des {
    border-bottom: 2px solid #5D5D5D !important;
    padding-bottom: 20px;
    padding-top: 20px;
}
.whates-caption.whates-caption2  .slider_footer_des {
    border-top: 2px solid #5D5D5D !important;
    padding-bottom: 20px;
    padding-top: 20px;
    cursor: pointer;
}
.whates-caption.whates-caption2  .slider_footer_des .read_more_btn{
 color: #506172 !important;
}
marquee {
  background: #fff;
  padding: 12px;
  border-radius: 10px;
  color: #000;
  font-size: 35px ;
  font-weight: bold;
  margin-bottom: 10px;
}

.ramdom-news-one .random-news {
  background: #fff !important;
  padding: 8px;
  margin-bottom: 20px;
}
.random-news h4 a{
  font-size: 16px !important;
}
.random-news h4 a:hover {
  color: red;
}
.random-news .first-word-big {
  font-size: 24px;
  color: #000;
  font-weight: bold;
}
.ramdom-news-two{
   margin-right: 0px !important;
   padding-right: 0px !important;
}
.ramdom-news-two h4 a{
   font-size: 16px !important;
   background: #fff !important;
}
.ramdom-news-two h4 a:hover {
  color: red;
}
.ramdom-news-two .first-word-big {
  font-size: 24px;
  color: #000;
  font-weight: bold;
}
.popular-news h4 a:hover {
  color: red;
}

.see-more a{
  display: flex;
  justify-content: end;
  align-items: center;
  gap: 10px;
  color: #5D5D5D;
  font-size: 16px;
  font-weight: bold;
}

.title-line {
  display: -webkit-box;
  overflow: hidden;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
.description-line {
  display: -webkit-box;
  overflow: hidden;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
.most-popular img{
  max-height: 140px !important;
  width: 100% !important;
}
.whats-news-area .whats-news-single .whates-img img {
  max-height: 190px !important;
  width: 100% !important;
}
</style>

<main>
  <div class="trending-area fix pt-25 gray-bg">
    <div class="container">
      <div class="trending-main">
        <div class="row">
          <div class="col-12">
            <marquee width="" direction="left" height="">
                @if($breakingNewsList)
                  @foreach($breakingNewsList as $breakingNews)
                    <a href="{{ url('news-details/' . $breakingNews->news->id) }}" style="color: #000;">{{ $breakingNews->news->title }}</a>
                  @endforeach
                @else
                  Breaking News
                @endif
            </marquee>
          </div>
          <div class="col-lg-8">
            <div class="owl-carousel owl-theme slider-carousel">
              @foreach($slider as $singleSlider)
              <div class="row mb-40">
                <div class="col-md-6">
                  <div class="whats-news-single mb-40 slider" style="background: #fff; padding: 10px; height: 100%;">
                    <div class="whates-caption whates-caption2">
                      <div class="d-flex justify-content-between slider_header_des">
                        <span class="date">{{ date('Y-m-d', strtotime($singleSlider->created_at)) }}</span>
                        <span class="category_name">{{ $singleSlider->category_name }}</span>
                      </div>
                      <h4>
                        <a href="{{ url('slider-details') }}/{{ $singleSlider->id }}">
                          <span class="first-word-big">{{ ucfirst(explode(' ', $singleSlider->title)[0]) }}</span>
                          {{ substr($singleSlider->title, strlen(explode(' ', $singleSlider->title)[0])) }}
                        </a>
                      </h4>
                      <p class="description" style="height: 75px; overflow: hidden;">{!! substr($singleSlider->description, 0, 180) !!}...</p>
                      <div class="d-flex justify-content-between align-items-center slider_footer_des">
                        <span class="" id="copyUrlButton" onclick="copyToClipboard('{{ url('slider-details') }}/{{ $singleSlider->id }}')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                            <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>
                          </svg>
                        </span>
                        <a href="{{ url('slider-details') }}/{{ $singleSlider->id }}" class="read_more_btn">
                          Read More
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-left: 5px;">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <a href="{{ url('slider-details') }}/{{ $singleSlider->id }}">
                    <img src="{{ asset($singleSlider->image) }}" class="img-fluid object-fit-cover" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                  </a>
                </div>
              </div>
              @endforeach
            </div>

            <div class="btn-wrap">
              <button class="prev-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16" style="margin-right: 5px;">
                  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Previous
              </button>
              <button class="next-btn">
                Next
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-left: 5px;">
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                </svg>
              </button>
            </div>
          </div>

          <!-- Right content -->
          <div class="col-lg-4">
            <div class="row ramdom-news-one">
              <div class="col-12 d-flex flex-column">
                <a href="{{ url('news-details') }}/{{ $randomNews[0]->id }}">
                  <img src="{{ asset($randomNews[0]->featured_image) }}" class="img-fluid" alt="" />
                </a>
                <div class="random-news flex-grow-1">
                  <h4>
                    <a href="{{ url('news-details') }}/{{ $randomNews[0]->id }}">
                      <span class="first-word-big">{{ ucfirst(explode(' ', $randomNews[0]->title)[0]) }}</span>
                      {{ substr($randomNews[0]->title, strlen(explode(' ', $randomNews[0]->title)[0])) }}
                    </a>
                  </h4>
                </div>
              </div>
            </div>
            <div class="ramdom-news-two d-flex flex-row gap-1">
              <div class="w-100" style="flex: 0 0 50%;">
                <a href="{{ url('news-details') }}/{{ $randomNews[1]->id }}">
                  <img src="{{ asset($randomNews[1]->featured_image) }}" class="img-fluid" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                </a>
              </div>
              <div class="w-100" style="background: #fff; padding: 20px; flex: 1;">
                <h4>
                  <a href="{{ url('news-details') }}/{{ $randomNews[1]->id }}">
                    <span class="first-word-big">{{ ucfirst(explode(' ', $randomNews[1]->title)[0]) }}</span>
                    {{ substr($randomNews[1]->title, strlen(explode(' ', $randomNews[1]->title)[0])) }}
                  </a>
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Whats New Start -->
  <section class="whats-news-area pt-50 pb-20 gray-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="whats-news-wrapper">
            <div class="row justify-content-between align-items-end mb-15">
              <div class="col-xl-4">
                <div class="section-tittle mb-30">
                  <span>What's New</span><br><br>
                  <h3 id="main-title"></h3>
                </div>
              </div>
              <div class="col-xl-8 col-md-9">
                <div class="properties__button">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      @foreach ($categories as $index => $category)
                      <a class="nav-item nav-link {{ $index === 0 ? 'active-category' : '' }}" data-category-id="{{ $category->id }}"
                         href="#" role="tab">
                          {{ $category->name }}
                      </a>
                      @endforeach
                    </div>
                  </nav>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12"> 
                <div id="news-content-container" class="row">
                    <!-- News content will be dynamically loaded here -->
                </div>
              </div>
            </div>
          </div>
          <!-- Banner -->
          <div class="banner-one mt-20 mb-30">
            <a href="{{ $ads->banner_ad_link }}" target="_blank">
              <img src="{{ asset($ads->banner_ad_img) }}" alt="Banner Ad">
            </a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="single-follow mb-45">
            <div class="single-box survey-owl-carousel owl-carousel" style="height: auto">
              @foreach($surveys as $survey)
              <div class="card" style="width: 100%;">
                <div class="">
                  <div class="card-header" style="background: #428bca;">
                    <span style="color: white;">{{ $survey->question }}</span>
                  </div>
                  <form action="{{ url('submit-vote') }}" method="post">
                    @csrf
                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                    <ul class="list-group list-group-flush" style="padding-left: 17px;">
                      @foreach($survey->options as $option)
                        <div class="list-group-item form-check">
                          <input class="form-check-input" type="radio" name="option_id" id="option{{ $option->id }}" value="{{ $option->id }}">
                          <label class="form-check-label" for="option{{ $option->id }}">
                            {{ $option->option }}
                          </label>
                        </div>
                      @endforeach
                    </ul>
                    <div class="card-header">
                      <button type="submit" class="btn btn-vote">Vote</button>
                    </div>
                  </form>
                </div>
              </div>
              @endforeach
            </div>
            <div class="btn-wrap">
              <button class="survey-prev-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16" style="margin-right: 5px;">
                  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Previous
              </button>
              <button class="survey-next-btn">
                Next
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-left: 5px;">
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                </svg>
              </button>
          </div>
          <div class="most-recent-area">
            <div class="small-tittle mb-20">
              <h4>Most Recent</h4>
            </div>
            <div class="most-recent mb-40">
              <div class="most-recent-img">
                <a href="{{ 'news-details/'.$recentNews[0]->id }}">
                  <img src="{{ asset($recentNews[0]->featured_image) }}"  alt="{{ $recentNews[0]->title }}" />
                </a>
                <div class="most-recent-cap">
                  <span class="bgbeg">{{ $recentNews[0]->category_name }}</span>
                  <h4>
                    <a href="{{ 'news-details/'.$recentNews[0]->id }}">{{ $recentNews[0]->title }}</a>
                  </h4>
                  <p>Published On: {{ date('Y-m-d', strtotime($recentNews[0]->created_at)) }}</p>
                </div>
              </div>
            </div>
            <div class="most-recent-single">
              <div class="most-recent-images">
                <img src="{{ asset($recentNews[1]->featured_image) }}" height="80" width="80" alt="" />
              </div>
              <div class="most-recent-capt">
                <h4>
                  <a href="{{ 'news-details/'.$recentNews[1]->id }}">{{ $recentNews[1]->title }}</a>
                </h4>
                <p>Published On: {{ date('Y-m-d', strtotime($recentNews[1]->created_at)) }}</p>
              </div>
            </div>
            <div class="most-recent-single">
              <div class="most-recent-images">
                <img src="{{ asset($recentNews[2]->featured_image) }}" height="80" width="80" alt="" />
              </div>
              <div class="most-recent-capt">
                <h4>
                  <a href="{{ 'news-details/'.$recentNews[2]->id }}">{{ $recentNews[2]->title }}</a>
                </h4>
                <p>Published On: {{ date('Y-m-d', strtotime($recentNews[2]->created_at)) }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="news-poster d-none d-lg-block">
          <a href="{{ $ads->sidebar_ad_link }}" target="_blank">
            <img src="{{ asset($ads->sidebar_ad_img) }}" alt="Sidebar Ad">
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Whats New End -->


  <!-- Recent News Section Start -->
  <div class="whats-news-area pt-50 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-tittle mb-30">
            <h3>Recent News</h3>
          </div>
        </div>
      </div>
      <div id="recent-news-content-container" class="row">
      </div>
      <div class="col-md-12 text-right see-more">
        <a href="{{ url('latest-news') }}"><span>See more</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-left: 5px;">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
  <!-- Recent News Section End -->

  <!--   Weekly2-News start -->
  <div class="weekly2-news-area pt-50 pb-30 gray-bg">
    <div class="container">
      <div class="weekly2-wrapper">
        <div class="row">
          <!-- Banner -->
          <div class="col-lg-3">
            <div class="home-banner2 d-none d-lg-block">
              <a href="{{ $ads->card_ad_link }}" target="_blank">
                <img src="{{ asset($ads->card_ad_img) }}" alt="Card Ad">
              </a>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="slider-wrapper">
              <!-- section Tittle -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="small-tittle mb-30">
                    <h4>Most Popular</h4>
                  </div>
                </div>
              </div>
              <!-- Slider -->


              <div class="row">
                <div class="col-lg-12">
                  <div class="weekly2-news-active d-flex">
                    @foreach($popularNews as $news)
                      <div class="col-lg-4 col-md-6">
                        <div class="whats-news-single mb-40 mb-40 popular-news">
                          <div class="whates-img most-popular">
                            <img src="{{ asset($news->featured_image) }}" class="img-fluid" alt="">
                          </div>
                          <div class="whates-caption whates-caption2">
                            <h4 class="title-line">
                              <a href="{{ 'news-details/'.$news->id }}">
                                <span class="first-word-big">{{ ucfirst(explode(' ', $news->title)[0]) }}</span>
                                {{ substr($news->title, strlen(explode(' ', $news->title)[0])) }}
                              </a>
                            </h4>
                            <p class="description-line">{!! substr($news->description, 0, 120) !!}...<a href="{{ 'news-details/'.$news->id }}" class="read-more">read more</a></p>
                            <div class="d-flex justify-content-between footer_des">
                              <span class="date">{{ date('Y-m-d', strtotime($news->created_at)) }}</span>
                              <span class="category_name">{{ $news->category_name }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Weekly-News -->
  <!-- Start Video Area -->
  <div class="youtube-area video-padding d-none d-sm-block">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="video-items-active">
            <div class="video-items text-center">
              <video controls  id="active-video">
                <source src="" type="video/mp4" />
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
        </div>
      </div>
      <div class="video-info">
        <div class="row">
          <div class="col-12">
            <div class="testmonial-nav text-center">
              @foreach($reels as $index => $reel)
                @if($reel->content_type == 3 && !empty($reel->other_url))
                  <div class="single-video" data-video-src="{{ asset($reel->other_url) }}">
                    <video controls>
                      <source src="{{ asset($reel->other_url) }}"  type="video/mp4" />
                      Your browser does not support the video tag.
                    </video>
                    <div class="video-intro">
                      <h4>{{ $reel->title }}</h4>
                    </div>
                  </div>
                @elseif($reel->content_type == 4 && !empty($reel->video))
                  <div class="single-video" data-video-src="{{ asset($reel->video) }}">
                    <video controls>
                      <source src="{{ asset($reel->video) }}"  type="video/mp4" />
                      Your browser does not support the video tag.
                    </video>
                    <div class="video-intro">
                      <h4>{{ $reel->title }}</h4>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Start Video area-->

  <!-- Other News Section Start -->
  <div class="whats-news-area pt-50 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-tittle mb-30">
            <h3>Other News</h3>
          </div>
        </div>
      </div>
      <div id="other-news-content-container" class="row">
      </div>
      <div class="col-md-12 text-right see-more">
        <a href="{{ url('latest-news') }}"><span>See more</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-left: 5px;">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
  <!-- Other News Section End -->

  <!-- banner-last Start -->
  <div class="banner-area gray-bg pt-90 pb-90">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-10">
          <div class="banner-one">
            <a href="{{ $ads->footer_top_ad_link }}" target="_blank">
              <img src="{{ asset($ads->footer_top_ad_img) }}" alt="Footer Top Ad">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- banner-last End -->
</main>
<script src="//vjs.zencdn.net/8.3.0/video.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', async function () {
    const mainVideoPlayer = document.getElementById('active-video');
    const videoItems = document.querySelectorAll('.single-video');

    // Default to the latest video
    const latestVideo = videoItems[0];
    latestVideo.classList.add('active-selected-video');
    mainVideoPlayer.src = latestVideo.getAttribute('data-video-src');
    mainVideoPlayer.load();

    videoItems.forEach(function (video) {
      video.addEventListener('click', function () {
        mainVideoPlayer.pause();
        mainVideoPlayer.src = '';
        mainVideoPlayer.load();

        mainVideoPlayer.src = this.getAttribute('data-video-src');
        mainVideoPlayer.load();

        // Remove the 'active-selected-video' class from all videos
        videoItems.forEach(function (item) {
          item.classList.remove('active-selected-video');
        });

        // Add the 'active-selected-video' class to the clicked video
        this.classList.add('active-selected-video');
      });
    });

    await fetchRecentNews();
    await fetchOtherNews();

    document.querySelectorAll('.nav-link').forEach(function (tab) {
      tab.addEventListener('click', async function (event) {
        event.preventDefault();
        // Remove the 'active-category' class from all category links
        document.querySelectorAll('.nav-link').forEach(function (tab) {
          tab.classList.remove('active-category');
        });
        
        // Add the 'active-category' class to the clicked category link
        this.classList.add('active-category');

        const mainTitle = this.innerText;
        document.getElementById('main-title').innerText = mainTitle;

        const categoryId = this.getAttribute('data-category-id');
        await fetchNewsByCategory(categoryId);
      });
    });

    const firstCategoryId = document.querySelector('.nav-link').getAttribute('data-category-id');
    await fetchNewsByCategory(firstCategoryId);

    // First category link to display its content by default
    const firstCategoryLink = document.querySelector('.nav-link');
    firstCategoryLink.click();
  });

  async function fetchRecentNews() {
    try {
      var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}';
      var recentNewsUrl = baseUrl + '/api/recent-news?count=12'; // count = limit
      const response = await fetch(recentNewsUrl);
      const data = await response.json();
      console.log('Fetched Recent News Data:', data.data);

      if (Array.isArray(data.data)) {
        const recentNewsContentContainer = document.getElementById('recent-news-content-container');
        recentNewsContentContainer.innerHTML = generateRecentNewsHTML(data.data);

      } else {
        console.error('Invalid data format. Expected an array.');
      }

    } catch (error) {
      console.error('Error fetching recent news:', error);
    }
  }

  async function fetchOtherNews() {
    try {
        var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}';
        var newsUrl = baseUrl + '/api/news?count=12'; // count = limit
        const response = await fetch(newsUrl);
        const data = await response.json();
        console.log('Fetched Other News Data:', data.data);

        if (Array.isArray(data.data)) {
            const otherNewsContentContainer = document.getElementById('other-news-content-container');
            otherNewsContentContainer.innerHTML = generateOtherNewsHTML(data.data);
        } else {
            console.error('Invalid data format. Expected an array.');
        }
    } catch (error) {
        console.error('Error fetching other news:', error);
    }
  }


  function generateRecentNewsHTML(recentNewsData) {
    let html = '';

    if (!recentNewsData || recentNewsData.length === 0) {
      // Display a message when no recent news is found
      html = '<div class="col-12"><p class="text-center">Sorry! Recent News not found.</p></div>';
    } else {
      recentNewsData.forEach(news => {
        const newsDate = new Date(news.created_at);
        // Format date as YYYY-MM-DD
        const formattedDate = `${newsDate.getFullYear()}-${(newsDate.getMonth() + 1).toString().padStart(2, '0')}-${newsDate.getDate().toString().padStart(2, '0')}`;

        // Split the title into words
        const titleWords = news.title.split(' ');
        const modifiedTitle = titleWords.map((word, index) => {
          return index === 0 ? `<span class="first-word-big">${word}</span>` : word;
        }).join(' ');

        html += `
        <div class="col-lg-4 col-md-6">
          <div class="whats-news-single mb-40 mb-40">
            <div class="whates-img">
              <a href="{{ url('news-details') }}/${news.id}">
                <img src="{{ asset('') }}/${news.featured_image}" alt="">
              </a>
            </div>
            <div class="whates-caption whates-caption2">
              <h4 class="title-line"><a href="{{ url('news-details') }}/${news.id}">${modifiedTitle}</a></h4
              <p>${news.description.slice(0, 100)}...<a href="{{ url('news-details') }}/${news.id}" class="read-more">read more</a></p>
              <div class="d-flex justify-content-between footer_des">
                <span class="date">${formattedDate}</span>
                <span class="category_name">${news.category_name}</span>
              </div>
            </div>
          </div>
        </div>
        `;
      });
    }

    return html;
  }

  function generateOtherNewsHTML(otherNewsData) {
    let html = '';

    if (!otherNewsData || otherNewsData.length === 0) {
      // Display a message when no recent news is found
      html = '<div class="col-12"><p class="text-center">Sorry! News not found.</p></div>';
    } else {
      otherNewsData.forEach(news => {
        const newsDate = new Date(news.created_at);
        // Format date as YYYY-MM-DD
        const formattedDate = `${newsDate.getFullYear()}-${(newsDate.getMonth() + 1).toString().padStart(2, '0')}-${newsDate.getDate().toString().padStart(2, '0')}`;

        // Split the title into words
        const titleWords = news.title.split(' ');
        const modifiedTitle = titleWords.map((word, index) => {
          return index === 0 ? `<span class="first-word-big">${word}</span>` : word;
        }).join(' ');

        html += `
        <div class="col-lg-4 col-md-6">
          <div class="whats-news-single mb-40 mb-40">
            <div class="whates-img">
              <a href="{{ url('news-details') }}/${news.id}">
                <img src="{{ asset('') }}/${news.featured_image}" alt="">
              </a>
            </div>
            <div class="whates-caption whates-caption2">
              <h4 class="title-line"><a href="{{ url('news-details') }}/${news.id}">${modifiedTitle}</a></h4
              <p>${news.description.slice(0, 100)}...<a href="{{ url('news-details') }}/${news.id}" class="read-more">read more</a></p>
              <div class="d-flex justify-content-between footer_des">
                <span class="date">${formattedDate}</span>
                <span class="category_name">${news.category_name}</span>
              </div>
            </div>
          </div>
        </div>
        `;
      });
    }

    return html;
  }

  async function fetchNewsByCategory(categoryId) {
    try {
      // var baseUrl = '{{ config('app.url') }}';
      var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
      var categoryNews = baseUrl + '/api/news/category/' + categoryId + '?count=8'; //count = limit
      const response = await fetch(categoryNews);
      const data = await response.json();
      console.log('Fetched Data:', data.data.data);

      if (Array.isArray(data.data.data)) {
        const newsContentContainer = document.getElementById('news-content-container');
        newsContentContainer.innerHTML = generateNewsHTML(data.data.data);

      } else {
        console.error('Invalid data format. Expected an array.');
      }

    } catch (error) {
      console.error('Error fetching news:', error);
    }
  }

  function generateNewsHTML(newsData) {
    let html = '';
  
    if (!newsData || newsData.length === 0) {
      // Display a message when no news is found for the category
      html = '<div class="col-12"><p class="text-center">Sorry! News not found for this category.</p></div>';
    } else {
      newsData.forEach(news => {
        const newsDate = new Date(news.created_at);
        // Format date as YYYY-MM-DD
        const formattedDate = `${newsDate.getFullYear()}-${(newsDate.getMonth() + 1).toString().padStart(2, '0')}-${newsDate.getDate().toString().padStart(2, '0')}`;

        // Split the title into words
        const titleWords = news.title.split(' ');
        const modifiedTitle = titleWords.map((word, index) => {
          return index === 0 ? `<span class="first-word-big">${word}</span>` : word;
        }).join(' ');
        
        html += `
        <div class="col-xl-6 col-lg-6 col-md-6">
          <div class="whats-news-single mb-40 mb-40">
            <div class="whates-img">
              <a href="{{ url('news-details') }}/${news.id}">
                <img src="{{ asset('') }}/${news.featured_image}" alt="">
              </a>
            </div>
            <div class="whates-caption whates-caption2">
              <h4 class="title-line"><a href="{{ url('news-details') }}/${news.id}">${modifiedTitle}</a></h4>
              <p>${news.description.slice(0, 100)}...<a href="{{ url('news-details') }}/${news.id}" class="read-more">read more</a></p>
              <div class="d-flex justify-content-between footer_des">
                <span class="date">${formattedDate}</span>
                <span class="category_name">${news.category_name}</span>
              </div>
            </div>
          </div>
        </div>
        `;
      });
    }

    return html;
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

