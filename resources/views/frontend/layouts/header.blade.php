<style>
    .header-area .header-bottom {
      background-color: {{ $webConfiguration->web_color }};
    }

    .main-header .main-menu ul li a,
    .main-header .nav-search i {
      color: {{ $webConfiguration->nav_text_color }};
    }

    .main-header .main-menu ul li a:hover {
      color: {{ $webConfiguration->nav_text_color }};
    }

    .mobile_menu .slicknav_menu .slicknav_btn .slicknav_icon-bar {
      background-color: {{ $webConfiguration->nav_text_color }} !important;
    }
    
    .main-header .main-menu ul li a::before,
    .header-area .header-bottom .header-social::before,
    .header-area .header-bottom .header-social::after ,
    .main-header .nav-search::before {
      background-color: {{ $webConfiguration->nav_text_color }};
    }
</style>
<header>
  <!-- Header Start -->
  <div class="header-area">
    <div class="main-header">
      <div class="header-mid gray-bg">
        <div class="container">
          <div class="row d-flex align-items-center">
            <!-- Logo -->
            <div class="col-xl-3 col-lg-3 col-md-3 d-none d-md-block">
              <div class="logo">
                <a href="{{ url('/') }}"
                  ><img src="{{ asset($webConfiguration->header_logo) }}" width="70" alt="Logo"
                /></a>
              </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9"> 
              <div class="header-banner f-right">
                <a href="{{ $ads->header_ad_link }}" target="_blank">
                  <img src="{{ asset($ads->header_ad_img) }}" alt="Header Ad">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-bottom header-sticky">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-8 col-lg-8 col-md-12 header-flex">
              <!-- sticky -->
              <div class="sticky-logo">
                <a href="{{ url('/') }}"
                  ><img src="{{ asset($webConfiguration->header_logo) }}" width="50" alt="Logo"
                /></a>
              </div>
              <!-- Main-menu -->
              <div class="main-menu d-none d-md-block">
                <nav>
                  <ul id="navigation">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/latest-news') }}">Latest News</a></li>
                    <li><a href="{{ url('/categories') }}">Category</a></li>
                    <li>
                      <a href="#">Pages</a>
                      <ul class="submenu">
                        @foreach($pages as $page)
                          <li><a href="{{ url('/pages/' . $page->slug) }}">{{ $page->title }}</a></li>
                        @endforeach
                        <li id="loginLink"><a href="{{ url('/user-login') }}">Login</a></li>
                        <li id="userProfiletLink"><a href="{{ url('/user-profile') }}">Profile</a></li>
                        <li id="logoutLink"><a href="#" onclick="logout()">Logout</a></li>
                      </ul>
                    </li>
                    <li class="contact"><a href="{{ url('/contact') }}">Contact</a></li>
                  </ul>
                </nav>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
              <div class="header-right f-right d-none d-lg-block">
                <!-- Heder social -->
                <ul class="header-social">
                  @foreach($socials as $social)
                  <li>
                    <a href="{{ $social->link }}"  target="_blank"> <img src="{{ asset($social->icon) }}" height="20" alt="Icon"></a>
                  </li>
                  @endforeach
                </ul>
                <!-- Search Nav -->
                <div class="nav-search search-switch">
                  <i class="fa fa-search"></i>
                </div>
              </div>
            </div>
            <!-- Mobile Menu -->
            <div class="col-12">
              <div class="mobile_menu d-block d-md-none"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header End -->
</header>

<script>
  var accessToken = localStorage.getItem('access_token');

  if (accessToken) {
    document.getElementById('loginLink').style.display = 'none';
  }
  if (!accessToken) {
    document.getElementById('logoutLink').style.display = 'none';
    document.getElementById('userProfiletLink').style.display = 'none';
  }

  async function logout() {
    try {
      // var baseUrl = '{{ config('app.url') }}';
      var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
      let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
      let accessToken = localStorage.getItem('access_token');

      if (!accessToken) {
        console.error("Access token not found");
        return;
      }

      let res = await fetch(baseUrl + "/api/auth/logout", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Authorization': `Bearer ${accessToken}`,
        },
      });

      let data = await res.json();

      if (data.status === 'success') {
        localStorage.removeItem('access_token');
        localStorage.removeItem('user_id');
      
        Swal.fire({
          icon: 'success',
          text: data.message,
          showConfirmButton: false,
          timer: 1500,
        });

        window.location.href = '{{ url('/') }}';
      } 

    } catch (error) {
      console.error("An error occurred:", error);
    }
  }
</script>

