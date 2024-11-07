@extends('backend.layouts.app')
@section('content')
<!-- Custome CSS -->
<style>
    .info-box {
        background-color: #fff;
        display: flex; 
        justify-content: center; 
        align-items: center; 
        padding: 22px;
    }

    .info-box .icon-container {
        width: 70px; 
        height: 70px; 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        z-index: 1;
    }

    .info-box .icon-container .icon {
        color: red; 
        height: 26px; 
        width: 26px; 
        z-index: 2;
    }

    .info-box .total-count {
        color: #323232;
        font-size: 30px; 
        font-weight: bold;
    }

    .info-box .label {
        color: #87888C; 
        margin: 0px;
    }

    .category .icon-container,
    .location .icon-container,
    .users .icon-container {
        background-color: #F0F4FE;
    } 

    .news .icon-container,
    .tag .icon-container,
    .pages .icon-container {
        background-color: #FEF7E3;
    } 

    .breaking-news .icon-container,
    .admin .icon-container {
        background-color: #FDF4F1;
    } 

    .live-stream .icon-container,
    .language .icon-container {
        background-color: #EFEFFE;
    } 

    .slider .icon-container,
    .emails .icon-container {
        background-color: #E8F6EF;
    } 

    .category:hover,
    .location:hover,
    .users:hover {
        background-color: #F0F4FE;
    }

    .news:hover,
    .tag:hover,
    .pages:hover {
        background-color: #FEF7E3;
    }

    .breaking-news:hover,
    .admin:hover {
        background-color: #FDF4F1;
    }

    .live-stream:hover,
    .language:hover {
        background-color: #EFEFFE;
    }

    .slider:hover,
    .emails:hover {
        background-color: #E8F6EF;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <a href="{{ url('category/list') }}">
                    <div class="info-box category">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/category.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalCategories }}+</span>
                            <span class="label">Total Category</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('news/list') }}">
                    <div class="info-box news">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/news.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalNews }}+</span>
                            <span class="label">Total News</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('breaking-news/list') }}">
                    <div class="info-box breaking-news">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/breaking-news.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalBreakingNews }}+</span>
                            <span class="label">Total Breaking News</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('reel/list') }}">
                    <div class="info-box live-stream">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/live-stream.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalReels }}+</span>
                            <span class="label">Total Reels</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('slider/list') }}">
                    <div class="info-box slider">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/slider.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalSliders }}+</span>
                            <span class="label">Total Sliders</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('language/list') }}">
                    <div class="info-box language">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/language.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalLanguages }}+</span>
                            <span class="label">Total Languages</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('location/list') }}">
                    <div class="info-box location">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/location.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalLocations }}+</span>
                            <span class="label">Total Locations</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('tag/list') }}">
                    <div class="info-box tag">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/tag.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalTags }}+</span>
                            <span class="label">Total Tags</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('admin/list') }}">
                    <div class="info-box admin">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/admin.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalAdmins }}+</span>
                            <span class="label">Total Admins</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('users/list') }}">
                    <div class="info-box users">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/users.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalUsers }}+</span>
                            <span class="label">Total Users</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('page/list') }}">
                    <div class="info-box pages">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/pages.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalUPages }}+</span>
                            <span class="label">Total Pages</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ url('email/list') }}">
                    <div class="info-box emails">
                        <div class="icon-container">
                            <img class="icon" src="{{ asset('backend/icons/email.png') }}" alt="">
                        </div>
                        <div class="info-box-content ps-3">
                            <span class="total-count">{{ $totalEmails }}+</span>
                            <span class="label">Total Emails</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category Wise News</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Language Wise News</h3>
                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection