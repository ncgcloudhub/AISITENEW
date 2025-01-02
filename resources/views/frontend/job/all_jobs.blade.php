@extends('admin.layouts.master-without-nav')
@section('title', $seo->title)

@section('description', $seo->description)

@section('keywords', $seo->keywords)
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('body')


    <body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')
    <!-- Begin page -->
    <div class="layout-wrapper landing d-flex flex-column min-vh-100">
        @include('frontend.body.nav_frontend')

        <!-- Content should grow to push the footer down -->
        <div class="flex-grow-1 hero-section">
            <!-- start Jobs -->
            @include('frontend.body.job_main')
            <!-- end Jobs -->
        </div>

        <!-- Start footer -->
        @include('frontend.body.footer_frontend')
        <!-- end footer -->

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->
    </div>
    <!-- end layout wrapper -->
@endsection

    @section('script')

        <script src="{{ URL::asset('build/js/pages/landing.init.js') }}"></script>
       
    @endsection
