<style>
  .mobile-apps .google-play,
  .mobile-apps .app-store{
    width: 160px;
    margin-right: 7px;
  }
</style>
<footer>
  <!-- Footer Start-->
  <div class="footer-main footer-bg">
    <div class="footer-area footer-padding">
      <div class="container">
        <div class="row d-flex justify-content-between">
          <div class="col-xl-3 col-lg-3 col-md-5 col-sm-8">
            <div class="single-footer-caption mb-50">
              <div class="single-footer-caption mb-30">
                <!-- logo -->
                <div class="footer-logo">
                  <a href="{{ url('/') }}  "
                    ><img src="{{ asset($webConfiguration->footer_logo) }}" width="80" alt="Footer Logo"
                  /></a>
                </div>
                <div class="footer-tittle">
                  <div class="footer-pera">
                    <p class="info1">{{ $webConfiguration->footer_description }}</p>
                    <p class="info2">{{ $webConfiguration->footer_address }}</p>
                    <p class="info2">
                      Phone: <span>{{ $webConfiguration->footer_contact }}</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <h4>Popular post</h4>
              </div>
              <!-- Popular post -->
              @foreach($popularNews->take(3) as $news)
              <div class="whats-right-single mb-20">
                <div class="whats-right-img">   
                  @php
                  $imagePath = asset($news->featured_image);
                  @endphp
                  <img src="{{ $imagePath }}" height="80" width="70" alt="{{ $news->title }}" class="cover"/>
                </div>
                <div class="whats-right-cap">
                  <h4>
                    <a href="{{ url('news-details', $news->id) }}">{{ $news->title }}</a>
                  </h4>
                  <p>Published On: {{ date('Y-m-d', strtotime($news->created_at)) }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
            <div class="single-footer-caption mb-50">
              <div class="banner">
                <a href="{{ $ads->footer_ad_link }}" target="_blank">
                  <img src="{{ asset($ads->footer_ad_img) }}" alt="Header Ad">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="text-center text-md-left text-white">Follow Us</p>
            <ul class="d-flex justify-content-center justify-content-md-start" style="padding-bottom: 10px;">
              @foreach($socials as $social)
              <li style="padding-right: 10px;">
                <a href="{{ $social->link }}"  target="_blank"> <img src="{{ asset($social->icon) }}" height="20" alt="Icon"></a>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-6">
            <p class="text-center text-md-right text-white">Download Mobile Apps</p>
            <div class="mobile-apps d-flex justify-content-center justify-content-md-end">
              <a href="{{ $webConfiguration->google_play_app_link }}">
                <img class="google-play" src="{{ asset($webConfiguration->google_play_app_logo) }}" alt="">
              </a>
              <a href="{{ $webConfiguration->app_store_link }}">
                <img class="app-store" src="{{ asset($webConfiguration->app_store_logo) }}" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer-bottom aera -->
    <div class="footer-bottom-area footer-bg">
      <div class="container">
        <div class="footer-border">
          <div class="row d-flex align-items-center">
            <div class="col-xl-12">
              <div class="footer-copy-right text-center">
                <p>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  {{ $webConfiguration->copyright }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End-->
</footer>
