<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ChariTeam - Free Nonprofit Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- CSS Start -->
    @include('layouts2.guest.css')
    <!-- CSS End -->
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    @include('layouts2.guest.header')
    <!-- Navbar End -->

    @yield('content')

    <!-- (Bagian tengah: Causes, Service, Donate, Team, Testimonial) -->
    <!-- [tidak diubah, hanya dirapikan seperti bagian atas] -->

    <!-- Footer Start -->
    @include('layouts2.guest.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- JS Start -->
    @include('layouts2.guest.js')
    <!-- JS End -->

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281918980969?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20sistem%20ini"
        class="whatsapp-float" target="_blank" title="Hubungi via WhatsApp">
        <img src="{{ asset('assets/img/wa.png') }}" alt="WhatsApp">
    </a>

    <!-- Style Floating WhatsApp -->
    
</body>

</html>
