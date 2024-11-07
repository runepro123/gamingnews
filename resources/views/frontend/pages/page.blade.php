@extends('frontend.layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-5">
                <h2 class="text-center" style="font-weight: bold;">{{ $page->title }}</h2>
            </div>
            <div class="col-md-12 py-4">
                {!! $page->page_content !!}
            </div>
        </div>
    </div>
</main>
@endsection