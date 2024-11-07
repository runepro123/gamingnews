@extends('frontend.layouts.app')
@section('content')
<style>
    .read-more {
    color: #007bff; 
    text-decoration: none;
    margin-top: 5px;
    display: inline-block;
    }

    .read-more:hover {
        color: red; 
    }
</style>

<main>
    <!-- About US Start -->
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="whats-news-wrapper">
                        <!-- Heading & Nav Button -->
                        <div class="row justify-content-between align-items-end mb-15">
                            <div class="col-xl-12">
                                <div class="section-tittle mb-30">
                                    <h3>{{ $categoryName }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- Tab content -->
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav Card -->
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- card one -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">       
                                        <div id="news-content-container" class="row">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Nav Card -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- New Poster -->
                    <div class="news-poster d-none d-lg-block">
                        <a href="{{ $ads->sidebar_ad_link }}" target="_blank">
                            <img src="{{ asset($ads->sidebar_ad_img) }}" alt="Sidebar Ad">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About US End -->
    <!--Start pagination -->
    <div class="pagination-area  gray-bg pb-45">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap">
                        <nav aria-label="Page navigation example">
                            <ul id="pagination-links" class="pagination justify-content-start">
                                
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pagination  -->
</main>

<script>
    document.addEventListener('DOMContentLoaded', async function () {
        await fetchNewsByCategory({{ $categoryId }});
    });

    async function fetchNewsByCategory(categoryId, page = 1) {
        try {
            // var baseUrl = '{{ config('app.url') }}';
            var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
            var categoryNews = baseUrl + '/api/news/category/' + categoryId + '?count=8&page=' + page; // count = limit
            const response = await fetch(categoryNews);
            const data = await response.json();
            console.log('Fetched Data:', data.data);

            if (Array.isArray(data.data.data)) {
                const newsContentContainer = document.getElementById('news-content-container');
                newsContentContainer.innerHTML = generateNewsHTML(data.data.data);

                // Update pagination links
                const paginationContainer = document.getElementById('pagination-links');
                paginationContainer.innerHTML = generatePaginationHTML(data.data);
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
                // var baseUrl = '{{ config('app.url') }}';
                var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
                const imageSrc = baseUrl + '/' +  news.featured_image;
                // Format date as YYYY-MM-DD
                const formattedDate = `${newsDate.getFullYear()}-${(newsDate.getMonth() + 1).toString().padStart(2, '0')}-${newsDate.getDate().toString().padStart(2, '0')}`;

                html += `
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="whats-news-single mb-40 mb-40">
                            <div class="whates-img">
                                <img src="{{ asset('') }}/${news.featured_image}" alt="">
                            </div>
                            <div class="whates-caption whates-caption2">
                                <h4><a href="{{ url('news-details') }}/${news.id}">${news.title}</a></h4>
                                <span>Published On: ${formattedDate}</span>
                                <p>${news.description.slice(0, 100)}...<a href="{{ url('news-details') }}/${news.id}" class="read-more">read more</a></p>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        return html;
    }

    function generatePaginationHTML(data) {
        let html = '';

        if (data.last_page > 1) {
            // Previous button
            html += `
                <li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="fetchNewsByCategory({{ $categoryId }}, ${data.current_page - 1}); return false;" aria-label="Previous">
                        <!-- SVG icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="15px">
                            <path fill-rule="evenodd" fill="rgb(221, 221, 221)" d="M8.142,13.118 L6.973,14.135 L0.127,7.646 L0.127,6.623 L6.973,0.132 L8.087,1.153 L2.683,6.413 L23.309,6.413 L23.309,7.856 L2.683,7.856 L8.142,13.118 Z"/>
                        </svg>
                    </a>
                </li>
            `;

            // Page links
            const maxVisiblePages = 5; // Number of pages to show around the current page
            const startPage = Math.max(data.current_page - Math.floor(maxVisiblePages / 2), 1);
            const endPage = Math.min(startPage + maxVisiblePages - 1, data.last_page);

            for (let i = startPage; i <= endPage; i++) {
                html += `
                    <li class="page-item ${i === data.current_page ? 'active' : ''}">
                        <a class="page-link ${i === data.current_page ? 'text-danger' : 'text-black'}" href="#" onclick="fetchNewsByCategory({{ $categoryId }}, ${i}); return false;">${i}</a>
                    </li>
                `;
            }

            // Next button
            html += `
                <li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="fetchNewsByCategory({{ $categoryId }}, ${data.current_page + 1}); return false;" aria-label="Next">
                        <!-- SVG icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="15px">
                            <path fill-rule="evenodd" fill="rgb(255, 11, 11)" d="M31.112,13.118 L32.281,14.136 L39.127,7.646 L39.127,6.624 L32.281,0.132 L31.167,1.154 L36.571,6.413 L0.491,6.413 L0.491,7.857 L36.571,7.857 L31.112,13.118 Z"/>
                        </svg>
                    </a>
                </li>
            `;
        }

        return html;
    }
</script>
@endsection
