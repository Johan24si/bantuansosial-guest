@extends('layouts2.guest.app')
@section('content')
<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Tentang Kami Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative overflow-hidden h-100" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100 pt-5 pe-5" src="assets/img/about-1.jpg" alt="" style="object-fit: cover;">
                    <img class="position-absolute top-0 end-0 bg-white ps-2 pb-2" src="assets/img/about-2.jpg" alt="" 
                         style="width: 200px; height: 200px;">
                </div>
            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">

                    <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">
                        Tentang Kami
                    </div>

                    <h1 class="display-6 mb-5">Kami Membantu Masyarakat yang Membutuhkan</h1>

                    <div class="bg-light border-bottom border-5 border-primary rounded p-4 mb-4">
                        <p class="text-dark mb-2">
                            Kami berkomitmen untuk memberikan bantuan bagi masyarakat yang membutuhkan, 
                            melalui berbagai program sosial yang berkelanjutan dan bermanfaat.
                        </p>
                        <span class="text-primary">Jhon Doe, Pendiri</span>
                    </div>

                    <p class="mb-5">
                        Melalui kerja sama yang kuat antara pemerintah, lembaga sosial, dan para relawan, 
                        kami terus berupaya menciptakan dampak positif bagi masyarakat. 
                        Setiap program dirancang untuk memberikan manfaat nyata dan meningkatkan 
                        kesejahteraan warga yang membutuhkan.
                    </p>

                    <a class="btn btn-primary py-2 px-3 me-3" href="">
                        Selengkapnya
                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>

                    <a class="btn btn-outline-primary py-2 px-3" href="">
                        Hubungi Kami
                        <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
    <!-- Modul Deskripsi Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">
                Modul Sistem
            </div>
            <h1 class="display-6 mb-4">Deskripsi Modul Aplikasi</h1>
            <p>Modul ini dikembangkan untuk mempermudah proses pendataan, verifikasi, hingga pelaporan bantuan sosial secara cepat, efisien, dan transparan.</p>
        </div>

        <div class="row g-5 align-items-center">

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h3 class="mb-3">🎯 Tujuan Pengembangan Modul</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Mempermudah pengelolaan data peserta bantuan</li>
                    <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Mempercepat proses verifikasi dan validasi data</li>
                    <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Menyediakan laporan otomatis dan akurat</li>
                    <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Mendukung layanan yang transparan kepada masyarakat</li>
                </ul>

                <h3 class="mt-4 mb-3">🔁 Alur Kerja Sistem</h3>
                <ol class="ps-3">
                    <li class="mb-2">User melakukan pendaftaran / input data</li>
                    <li class="mb-2">Admin melakukan verifikasi kelengkapan berkas</li>
                    <li class="mb-2">Data diproses ke sistem penilaian (scoring)</li>
                    <li class="mb-2">Status diterbitkan: diterima / ditolak</li>
                    <li class="mb-2">Laporan dapat diunduh oleh admin</li>
                </ol>
            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <img src="assets/img/workflow.jpg" class="img-fluid rounded shadow" alt="Alur Kerja Sistem">
            </div>

        </div>

    </div>
</div>
<!-- Modul Deskripsi End -->
<!-- Developer Profile Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">
                Developer Profile
            </div>
            <h1 class="display-6 mb-4">Profil Pengembang</h1>
            <p>Halaman ini menjelaskan identitas pengembang aplikasi, tujuan pembuatan modul, serta proses alur kerja sistem.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="team-item position-relative rounded overflow-hidden shadow">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="assets/img/developer.jpg" alt="Foto Pengembang">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>M. Johan A Putra</h5>
                        <p class="text-primary mb-3">NIM: 2457301094 • Prodi: Sistem Informasi</p>

                        <div class="team-social text-center mt-3">
                            <!-- Facebook -->
                            <a class="btn btn-square" href="https://facebook.com/" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>

                            <!-- WhatsApp -->
                            <a class="btn btn-square" href="https://wa.me/628xxxxxxxxxx" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                            </a>

                            <!-- Instagram -->
                            <a class="btn btn-square" href="https://instagram.com/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>

                            <!-- Email -->
                            <a class="btn btn-square" href="mailto:email@example.com">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Developer Profile End -->
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">What We Do</div>
                <h1 class="display-6 mb-5">Learn More What We Do And Get Involved</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="assets/img/icon-1.png" alt="">
                        <h4 class="mb-3">Child Education</h4>
                        <p class="mb-4">Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed vero dolor duo.</p>
                        <a class="btn btn-outline-primary px-3" href="">
                            Learn More
                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="assets/img/icon-2.png" alt="">
                        <h4 class="mb-3">Medical Treatment</h4>
                        <p class="mb-4">Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed vero dolor duo.</p>
                        <a class="btn btn-outline-primary px-3" href="">
                            Learn More
                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="assets/img/icon-3.png" alt="">
                        <h4 class="mb-3">Pure Drinking Water</h4>
                        <p class="mb-4">Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed vero dolor duo.</p>
                        <a class="btn btn-outline-primary px-3" href="">
                            Learn More
                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Pendukung Program Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">
                Pendukung Program
            </div>
            <h1 class="display-6 mb-4">Mitra yang Berkontribusi untuk Kesejahteraan Bersama</h1>
            <p class="text-muted">Mereka yang turut mendukung program bantuan sosial demi membantu masyarakat.</p>
        </div>

        <div class="row g-4">

            <!-- Item Pendukung -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item position-relative rounded overflow-hidden">
                    <div class="overflow-hidden bg-light">
                        <img class="img-fluid" src="assets/img/team-1.jpg" alt="">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>Dinas Sosial</h5>
                        <p class="text-primary">Lembaga Pemerintah</p>
                    </div>
                </div>
            </div>

            <!-- Item Pendukung -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item position-relative rounded overflow-hidden">
                    <div class="overflow-hidden bg-light">
                        <img class="img-fluid" src="assets/img/team-2.jpg" alt="">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>Yayasan Peduli Sesama</h5>
                        <p class="text-primary">Organisasi Kemanusiaan</p>
                    </div>
                </div>
            </div>

            <!-- Item Pendukung -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item position-relative rounded overflow-hidden">
                    <div class="overflow-hidden bg-light">
                        <img class="img-fluid" src="assets/img/team-3.jpg" alt="">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>Perusahaan CSR</h5>
                        <p class="text-primary">Corporate Social Responsibility</p>
                    </div>
                </div>
            </div>

            <!-- Item Pendukung -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item position-relative rounded overflow-hidden">
                    <div class="overflow-hidden bg-light">
                        <img class="img-fluid" src="assets/img/team-4.jpg" alt="">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>Komunitas Relawan</h5>
                        <p class="text-primary">Relawan Sosial</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Pendukung Program End -->

     @endsection