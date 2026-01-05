<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login / Register</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg,
                        rgba(0,0,0,0.85) 0%,
                        rgba(241,90,41,0.2) 100%),
                        url('https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1600&q=80')
                        no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;

            /* Animasi background */
            background-size: 200% 200%;
            animation: bgMove 25s infinite alternate ease-in-out;
        }

        @keyframes bgMove {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 100%; }
        }

        /* Container dengan efek glassmorphism */
        .container {
            width: 460px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25),
                        0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Header dengan logo */
        .header {
            padding: 25px 30px 10px;
            text-align: center;
            background: linear-gradient(to right, #f15a29, #ff7b4e);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .logo-circle i {
            font-size: 28px;
            color: #f15a29;
        }

        .brand {
            font-weight: 800;
            font-size: 28px;
            letter-spacing: 1px;
            color: white;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .brand span.orange { color: white; }
        .brand span.black { color: rgba(255, 255, 255, 0.9); }

        .tagline {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            font-weight: 400;
            margin-top: 5px;
            letter-spacing: 0.5px;
        }

        /* Tabs styling */
        .tabs {
            display: flex;
            justify-content: space-around;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tab {
            flex: 1;
            padding: 18px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            color: #666;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .tab.active {
            color: #f15a29;
            background: rgba(255, 255, 255, 0.9);
        }

        .tab:not(.active):hover {
            color: #333;
            background: rgba(255, 255, 255, 0.6);
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #f15a29;
            animation: tabSlide 0.3s ease-out;
        }

        @keyframes tabSlide {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }

        /* Form container */
        .form-container {
            padding: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 26px;
            font-weight: 700;
            color: #222;
            position: relative;
            padding-bottom: 15px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #f15a29;
            border-radius: 2px;
        }

        /* Input groups */
        .input-group {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 15px 20px;
            border-radius: 12px;
            border: 2px solid #eee;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .input-group:hover {
            border-color: #f15a29;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(241, 90, 41, 0.1);
        }

        .input-group:focus-within {
            border-color: #f15a29;
            box-shadow: 0 0 0 3px rgba(241, 90, 41, 0.2);
            transform: translateY(-2px);
        }

        .input-group i {
            color: #f15a29;
            margin-right: 15px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        input::placeholder {
            color: #aaa;
            font-weight: 400;
        }

        /* Remember & Forgot Password */
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }

        .remember-me input {
            width: auto;
            margin-right: 8px;
            accent-color: #f15a29;
        }

        .forgot-password {
            color: #f15a29;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 5px 0;
        }

        .forgot-password:hover {
            text-decoration: underline;
            transform: translateY(-1px);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: #777;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider span {
            padding: 0 15px;
            font-weight: 500;
        }

        /* Social Login Buttons */
        .social-login {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            border-radius: 12px;
            border: 2px solid #eee;
            background: #fff;
            color: #333;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-btn i {
            font-size: 20px;
            margin-right: 15px;
        }

        .social-btn.google {
            border-color: #DB4437;
            color: #DB4437;
        }

        .social-btn.google:hover {
            background: rgba(219, 68, 55, 0.05);
            border-color: #DB4437;
        }

        .social-btn.facebook {
            border-color: #4267B2;
            color: #4267B2;
        }

        .social-btn.facebook:hover {
            background: rgba(66, 103, 178, 0.05);
            border-color: #4267B2;
        }

        /* Button styling */
        button, .btn-submit {
            width: 100%;
            background: linear-gradient(to right, #f15a29, #ff7b4e);
            color: #fff;
            padding: 18px;
            border: none;
            font-size: 17px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            letter-spacing: 0.5px;
            box-shadow: 0 5px 15px rgba(241, 90, 41, 0.3);
            position: relative;
            overflow: hidden;
            text-align: center;
            display: block;
            text-decoration: none;
        }

        button:hover, .btn-submit:hover {
            background: linear-gradient(to right, #d94b1a, #f15a29);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(241, 90, 41, 0.4);
        }

        button:active, .btn-submit:active {
            transform: translateY(0);
        }

        button::after, .btn-submit::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.7s;
        }

        button:hover::after, .btn-submit:hover::after {
            left: 100%;
        }

        /* Error message */
        .error-msg {
            color: #d32f2f;
            background: rgba(211, 47, 47, 0.08);
            border: 1px solid rgba(211, 47, 47, 0.2);
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            font-weight: 500;
            animation: shake 0.5s ease-in-out;
        }

        .success-msg {
            color: #2e7d32;
            background: rgba(46, 125, 50, 0.08);
            border: 1px solid rgba(46, 125, 50, 0.2);
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            font-weight: 500;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        /* Form transition */
        .form-transition {
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .hidden {
            display: none;
            opacity: 0;
            transform: translateX(20px);
        }

        /* Modal for forgot password */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            width: 90%;
            max-width: 400px;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: #222;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 28px;
            color: #777;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-modal:hover {
            background: #f5f5f5;
            color: #f15a29;
        }

        .modal-instructions {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 25px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 500px) {
            .container {
                width: 100%;
                max-width: 400px;
            }

            .form-container {
                padding: 25px;
            }

            .header {
                padding: 20px 25px 10px;
            }

            .logo-circle {
                width: 50px;
                height: 50px;
            }

            .logo-circle i {
                font-size: 24px;
            }

            .brand {
                font-size: 24px;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .social-login {
                gap: 12px;
            }

            .social-btn {
                padding: 14px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header dengan Logo -->
    <div class="header">
       <div class="logo-container d-flex align-items-center">
    <img src="{{ asset('assets/img/logo.png') }}"
         alt="Logo"
         style="height: 60px; width: auto;"
         class="me-2">

</div>

    </div>

    <!-- Tabs -->
    <div class="tabs">
        <div class="tab active" id="loginTab">Sign In</div>
        <div class="tab" id="registerTab">Sign Up</div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        {{-- LOGIN FORM --}}
        <form id="loginForm" class="form-transition" action="{{ route('login') }}" method="POST">
            @csrf
            @if(session('error'))
                <p class="error-msg">{{ session('error') }}</p>
            @endif

            <h2>Welcome Back</h2>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" name="text" placeholder="username" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="text" name="text" placeholder="Password" required>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" class="forgot-password" id="forgotPasswordLink">Forgot Password?</a>
            </div>

            <button type="submit">
                <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Sign In
            </button>

            <div class="divider">
                <span>Or continue with</span>
            </div>

            <div class="social-login">
                <div class="social-btn google" id="googleLogin">
                    <i class="fab fa-google"></i>
                    Sign in with Google
                </div>
                <div class="social-btn facebook" id="facebookLogin">
                    <i class="fab fa-facebook"></i>
                    Sign in with Facebook
                </div>
            </div>
        </form>

        {{-- REGISTER FORM --}}
        <form id="registerForm" class="form-transition hidden" action="{{ route('register') }}" method="POST">
            @csrf
            <h2>Join Our Team</h2>

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Full Name" required>
            </div>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Create Password" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <button type="submit">
                <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Create Account
            </button>

            <div class="divider">
                <span>Or sign up with</span>
            </div>

            <div class="social-login">
                <div class="social-btn google" id="googleRegister">
                    <i class="fab fa-google"></i>
                    Sign up with Google
                </div>
                <div class="social-btn facebook" id="facebookRegister">
                    <i class="fab fa-facebook"></i>
                    Sign up with Facebook
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal" id="forgotPasswordModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Reset Password</h3>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>

        <p class="modal-instructions">Enter your email address and we'll send you a link to reset your password.</p>

        <form id="forgotPasswordForm">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="resetEmail" placeholder="Email Address" required>
            </div>

            <div id="resetMessage" class="hidden"></div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Send Reset Link
            </button>
        </form>
    </div>
</div>

<script>
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    const forgotPasswordModal = document.getElementById('forgotPasswordModal');
    const closeModal = document.getElementById('closeModal');
    const googleLogin = document.getElementById('googleLogin');
    const facebookLogin = document.getElementById('facebookLogin');
    const googleRegister = document.getElementById('googleRegister');
    const facebookRegister = document.getElementById('facebookRegister');
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    const resetMessage = document.getElementById('resetMessage');

    // Fungsi untuk beralih antar form
    function switchToLogin() {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');

        // Sembunyikan register form dengan animasi
        registerForm.classList.add('hidden');

        // Tunggu sebentar untuk transisi, lalu tampilkan login form
        setTimeout(() => {
            loginForm.classList.remove('hidden');
        }, 200);
    }

    function switchToRegister() {
        registerTab.classList.add('active');
        loginTab.classList.remove('active');

        // Sembunyikan login form dengan animasi
        loginForm.classList.add('hidden');

        // Tunggu sebentar untuk transisi, lalu tampilkan register form
        setTimeout(() => {
            registerForm.classList.remove('hidden');
        }, 200);
    }

    // Event listeners untuk tabs
    loginTab.addEventListener('click', switchToLogin);
    registerTab.addEventListener('click', switchToRegister);

    // Modal untuk forgot password
    forgotPasswordLink.addEventListener('click', function(e) {
        e.preventDefault();
        forgotPasswordModal.style.display = 'flex';
    });

    closeModal.addEventListener('click', function() {
        forgotPasswordModal.style.display = 'none';
        resetMessage.classList.add('hidden');
        resetMessage.textContent = '';
        forgotPasswordForm.reset();
    });

    // Tutup modal ketika klik di luar konten modal
    window.addEventListener('click', function(e) {
        if (e.target === forgotPasswordModal) {
            forgotPasswordModal.style.display = 'none';
            resetMessage.classList.add('hidden');
            resetMessage.textContent = '';
            forgotPasswordForm.reset();
        }
    });

    // Form forgot password
    forgotPasswordForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('resetEmail').value;

        // Simulasi pengiriman email reset password
        // Dalam implementasi nyata, ini akan mengirim request ke backend

        resetMessage.classList.remove('hidden');
        resetMessage.classList.remove('error-msg');
        resetMessage.classList.remove('success-msg');

        if (email && email.includes('@')) {
            resetMessage.textContent = `Reset link has been sent to ${email}. Please check your email.`;
            resetMessage.classList.add('success-msg');

            // Reset form setelah 3 detik dan tutup modal setelah 5 detik
            setTimeout(() => {
                forgotPasswordForm.reset();
            }, 3000);

            setTimeout(() => {
                forgotPasswordModal.style.display = 'none';
                resetMessage.classList.add('hidden');
                resetMessage.textContent = '';
            }, 5000);
        } else {
            resetMessage.textContent = 'Please enter a valid email address.';
            resetMessage.classList.add('error-msg');
        }
    });

    // Login dengan Google
    function loginWithGoogle() {
        // Simulasi login Google
        // Dalam implementasi nyata, ini akan mengarahkan ke OAuth Google
        alert('Redirecting to Google authentication...');
        // window.location.href = '/auth/google'; // Contoh endpoint OAuth
    }

    // Login dengan Facebook
    function loginWithFacebook() {
        // Simulasi login Facebook
        // Dalam implementasi nyata, ini akan mengarahkan ke OAuth Facebook
        alert('Redirecting to Facebook authentication...');
        // window.location.href = '/auth/facebook'; // Contoh endpoint OAuth
    }

    // Event listeners untuk login sosial
    googleLogin.addEventListener('click', loginWithGoogle);
    facebookLogin.addEventListener('click', loginWithFacebook);
    googleRegister.addEventListener('click', loginWithGoogle);
    facebookRegister.addEventListener('click', loginWithFacebook);

    // Efek hover untuk input fields
    document.querySelectorAll('.input-group input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focus');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focus');
        });
    });

    // Animasi untuk tombol sosial
    document.querySelectorAll('.social-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>

</body>
</html>
