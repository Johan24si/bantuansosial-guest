<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login / Register</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1600&q=80')
                        no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;

            /* --- Tambahan animasi background bergerak --- */
            background-size: 150% 150%;
            animation: bgMove 20s infinite alternate ease-in-out;
        }

        @keyframes bgMove {
            0% { background-position: center top; }
            50% { background-position: center center; }
            100% { background-position: center bottom; }
        }
        /* --- Akhir tambahan animasi --- */


        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tabs {
            display: flex;
            justify-content: space-around;
            background: #f15a29;
            color: #fff;
        }

        .tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .tab.active {
            background: #d94b1a;
        }

        .form-container {
            padding: 30px;
        }

        .brand {
            text-align: center;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .brand span.orange { color: #f15a29; }
        .brand span.black { color: #222; }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
            color: #222;
        }

        .input-group {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .input-group:hover,
        .input-group:focus-within {
            border-color: #f15a29;
            box-shadow: 0 0 0 3px rgba(241, 90, 41, 0.2);
        }

        .input-group i {
            color: #f15a29;
            margin-right: 10px;
            font-size: 16px;
        }

        input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: #333;
            font-size: 15px;
        }

        button {
            width: 100%;
            background: #f15a29;
            color: #fff;
            padding: 14px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover { background: #d94b1a; }

        .error-msg {
            color: #b90000;
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.2);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        .hidden { display: none; }
    </style>
</head>
<body>

<div class="container">
    <div class="tabs">
        <div class="tab active" id="loginTab">Sign In</div>
        <div class="tab" id="registerTab">Sign Up</div>
    </div>

    <div class="form-container">
        <div class="brand"><span class="orange">Chari</span><span class="black">Team</span></div>

        {{-- LOGIN FORM --}}
        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf
            @if(session('error'))
                <p class="error-msg">{{ session('error') }}</p>
            @endif

            <h2>Login</h2>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">Sign In</button>
        </form>

        {{-- REGISTER FORM --}}
        <form id="registerForm" class="hidden" action="{{ route('register') }}" method="POST">
            @csrf
            <h2>Sign Up</h2>

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Full Name" required>
            </div>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</div>

<script>
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    loginTab.addEventListener('click', () => {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
    });

    registerTab.addEventListener('click', () => {
        registerTab.classList.add('active');
        loginTab.classList.remove('active');
        registerForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
    });
</script>

</body>
</html>
