@extends(auth()->check() ? 'admin.layouts.master' : 'admin.layouts.master-without-nav')

@section('title')
Error
@endsection

@section('body')
<body>
@endsection
@section('content')
        <div class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
                <div class="bg-overlay"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center pt-4">
                                <div class="">
                                    <img src="{{ URL::asset('build/images/error.svg') }}" alt="" class="error-basic-img move-animation">
                                </div>
                                <div class="mt-n4">
                                    <h1 class="display-1 fw-medium">404</h1>
                                    <h3 class="text-uppercase">Sorry, This page does not exists 😭</h3>
                                    <p class="text-muted mb-4">Please <a href="{{ route('contact.us')}}">Contact</a> Our Support!</p>
                                    <a href="{{ route('home')}}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Back to home</a>
                                    <a href="{{ route('contact.us')}}" class="btn btn-info"><i class="mdi mdi-contacts me-1"></i>Contact Us</a>

                                    <a class="btn btn-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span key="t-logout">@lang('translation.logout')</span></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->

            <!-- footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> © {{ $siteSettings->title }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- end auth-page-wrapper -->

@endsection
@section('script')
<!-- particles js -->
<script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
<!-- particles app js -->
<script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
