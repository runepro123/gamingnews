<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $webConfiguration->web_app_name }}</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="site.webmanifest" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="{{ asset($webConfiguration->header_logo) }}"
    />

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/ticker-style.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/flaticon.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slicknav.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/themify-icons.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/nice-select.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/style.css" />

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Include Owl Carousel CSS and JS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    />

    <!-- CSRF TToken -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body>
    <!-- Preloader Start -->
    <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="preloader-circle"></div>
          <div class="preloader-img pere-text">
            <img src="{{ asset($webConfiguration->header_logo) }}" width="70" alt="" />
          </div>
        </div>
      </div>
    </div>
    <!-- Preloader Start -->

    <!-- Header -->
    @include('frontend.layouts.header')

    <!-- Content  -->
    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <!-- Search model Begin -->
    <div class="search-model-box">
      <div class="d-flex align-items-center h-100 justify-content-center">
        <div class="search-close-btn">+</div>
        <form class="search-model-form" action="{{ url('search') }}" method="POST" id="search-form">
          @csrf
          <input
            type="text"
            id="search-input"
            name="query"
            placeholder="Search news....."
          />
        </form>
      </div>
    </div>
    <!-- Search model end -->

    <!-- JS here -->

    <script src="{{ asset('frontend') }}/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('frontend') }}/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="{{ asset('frontend') }}/assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>
    <script src=".{ asset('frontend') }}/assets/js/animated.headline.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="{{ asset('frontend') }}/assets/js/contact.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.form.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.validate.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/mail-script.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('frontend') }}/assets/js/plugins.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/main.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- Include jQuery and Owl Carousel JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
      $(document).ready(function () {
        // Initialize the slider carousel
        const sliderOwl = $(".owl-carousel.slider-carousel");

        sliderOwl.owlCarousel({
          loop: true,
          margin: 10,
          nav: false, 
          dots: false, 
          items: 1,
        });

        // Initialize the survey carousel
        const surveyOwl = $(".survey-owl-carousel");

        surveyOwl.owlCarousel({
          loop: true,
          margin: 10,
          nav: false,
          dots: false,
          autoHeight: true,
          items: 1,
        });

        $(".next-btn").click(function () {
          sliderOwl.trigger("next.owl.carousel");
        });

        $(".prev-btn").click(function () {
          sliderOwl.trigger("prev.owl.carousel");
        });

        $(".survey-next-btn").click(function () {
          surveyOwl.trigger("next.owl.carousel");
        });

        $(".survey-prev-btn").click(function () {
          surveyOwl.trigger("prev.owl.carousel");
        });
      });
    </script>


    <!-- JS For Search -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const searchInput = document.getElementById('search-input');
          const searchForm = document.getElementById('search-form');

          searchInput.addEventListener('keypress', function (event) {
              if (event.key === 'Enter') {
                  event.preventDefault(); // Prevent the default form submission
                  searchForm.submit(); // Manually submit the form
              }
          });
      });
    </script>
  </body>
</html>
