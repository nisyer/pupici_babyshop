<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/resetpassword.css') <!-- Optional CSS if you have -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f8ff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .reset-password-form {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-top: 1rem;
            font-weight: 600;
        }

       input[type="email"],
       input[type="password"] {
       width: 95%;
       padding: 0.6rem;
       margin-top: 0.3rem;
       border: 1px solid #ccc;
       border-radius: 6px;
       }

        .text-danger {
            color: red;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #ffe6e6;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 6px;
            color: #cc0000;
            text-align: center;
        }

        button[type="submit"] {
            margin-top: 1.5rem;
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 0.7rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="reset-password-form">
        <h2>Reset Password</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

       <form method="POST" action="{{ route('customer.password.update') }}">
    @csrf

    <label>Email:</label>
    <input type="email" name="email" required>
    @error('email') <span class="text-danger">{{ $message }}</span> @enderror

    <label>New Password:</label>
    <input type="password" name="password" required>
    @error('password') <span class="text-danger">{{ $message }}</span> @enderror

    <label>Confirm Password:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Reset Password</button>
</form>

    </div>
</body>
</html>
