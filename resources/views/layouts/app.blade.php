<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MegaHook Splitter</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="Maxim/assets/img/favicon.png" rel="icon">
    <link href="Maxim/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="Maxim/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="Maxim/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Maxim/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="Maxim/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="Maxim/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="Maxim/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="Maxim/assets/css/style.css" rel="stylesheet">

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .notification {
  animation: disappear 5s forwards;
}

@keyframes disappear {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

    </style>

</head>

<body style="position: relative;">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div class="logo">
                <h1><a href="/">Megahook Splitter</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}"  href="/">Home</a></li>
                    <li><a class="nav-link scrollto {{ Request::is('/services') ? 'active' : '' }}"  href="#services">Services</a></li>
                    <li><a class="{{ Request::is('pricing') ? 'active' : '' }}" href="/pricing">Pricing</a></li>
                    <li><a class="{{ Request::is('documentation') ? 'active' : '' }}"  href="/documentation">Documentation</a></li>

                    @auth
                        <li><a class="nav-link scrollto" href="{{ route('dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a class="nav-link scrollto" href="{{ route('login') }}">Sign in</a></li>
                    @endauth

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    {{ $slot }}

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>Megahook Splitter</h3>
                            <p>
                            6, ORE-OFE STREET, AKINBO PHASE 2 <br>
                            AKUTE, OGUN STATE, NIGERIA<br><br>
                                <strong>Phone:</strong> +2347011223737<br>
                                <strong>Email:</strong> info@megasprintlimited.com.ng<br>
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/documentation">Documentation</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Prices</a></li>
                        </ul>
                    </div>

                    {{-- <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div> --}}

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                    @if(session('success'))
                        <p style="position:absolute; top:0; right:0; padding:10px;" class="notification btn btn-success">{{session('success')}}</p>
                    @endif
                        <h4>Our Newsletter</h4>
                        <p>Subscribe to our news letters to get our latest updates and services</p>
                        <form action="/newsletter" method="post">
                            @csrf
                            <input type="email" name="email" value="{{@old('email')}}">
                            <x-input-error style="color:red; font-size: 0.65rem" :messages="$errors->get('email')" />
                            <!-- @error('email')
                                <span class="text-xs text-red-500">{{$message}}</span>
                            @enderror -->
                            <input type="submit" value="Subscribe">
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Megahook splitters</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
           

    <!-- Vendor JS Files -->
    <script src="Maxim/assets/vendor/aos/aos.js"></script>
    <script src="Maxim/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Maxim/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="Maxim/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="Maxim/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="Maxim/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="Maxim/assets/js/main.js"></script>

</body>

</html>
