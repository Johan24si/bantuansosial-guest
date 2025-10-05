<!DOCTYPE html>
<html>
<head>
    <title>Login Berhasil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            text-align: center;
            animation: fadeIn 1s ease;
        }
        h2 {
            color: #2e86de;
            margin-bottom: 10px;
        }
        p {
            color: #333;
            font-size: 16px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Berhasil!</h2>
        <p>Selamat datang, Anda berhasil masuk.</p>
    </div>
</body>
</html>
