<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            transition: 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4e73df;
            outline: none;
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }

        button {
            width: 100%;
            background-color: #4e73df;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #2e59d9;
        }

        p {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }

        p[style*="color:red"] {
            background-color: #f8d7da;
            color: #721c24 !important;
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div>
        <h2>Form Login</h2>

        @if(session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="/auth/login">
            @csrf
            <label>Username:</label>
            <input type="text" name="username" value="{{ old('username') }}">

            <label>Password:</label>
            <input type="password" name="password">

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
