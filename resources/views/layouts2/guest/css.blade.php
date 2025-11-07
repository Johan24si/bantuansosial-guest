 <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('assets/assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <style>
       .whatsapp-float {
    position: fixed;
    bottom: 25px;
    left: 35px; /* ubah dari right ke left */
    width: 60px;
    height: 60px;
    background-color: #f7faf8;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    z-index: 9999;
    transition: all 0.3s ease;
}

        .whatsapp-float img {
            width: 50px;
            height: 50px;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            background-color: #f3f7f5;
        }

        .whatsapp-float::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.418);
            animation: pulse 1.6s infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(1.8);
                opacity: 0;
            }
        }
        /* Avatar wrapper glow */
.nav-profile-wrap {
    padding: 2px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1b6ca8, #60a3d9);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Avatar image */
.nav-profile-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

/* Nama user */
.nav-profile-name {
    font-weight: 600;
    color: #fff !important;
    letter-spacing: 0.4px;
    transition: 0.3s;
}

/* Hover sedikit animate */
.nav-profile-name:hover {
    opacity: 0.8;
}

/* Dropdown Glass Effect */
.navbar-profile-dropdown {
    background: rgba(20, 30, 48, 0.85);
    backdrop-filter: blur(12px);
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    overflow: hidden;
    animation: fadeSlide 0.25s ease;
}

/* Item dropdown */
.navbar-profile-dropdown .dropdown-item {
    color: #e4e4e4;
    font-size: 15px;
    padding: 12px 20px;
    transition: 0.25s;
}

/* Hover dropdown */
.navbar-profile-dropdown .dropdown-item:hover {
    background: rgba(255,255,255,0.08);
    color: #fff;
}

/* Animasi muncul */
@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}
.nav-item.dropdown {
    margin-left: 15px; 
}
    </style>
