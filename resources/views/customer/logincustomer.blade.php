<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Login</title>
    @vite('resources/css/customerlogin.css')
</head>
<body>
    <a href="{{ route('login.choice') }}" class="back-button top-left">← Back</a>
    <div class="login-container">
        <div class="login-logo-wrapper">
            <img src="{{ asset('images/pupici-logo.png') }}" alt="PUPICI Logo" style="width: 150px;">
        </div>

        @if(session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('customer.login.submit') }}">
            @csrf

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>

            <div class="register-section">
                <span>Don't have an account?</span>
                <a href="{{ route('customer.register') }}" class="register-btn">Register here</a>
            </div>

            <div style="text-align:center; margin-top: 1rem;">
                <a href="{{ route('customer.password.reset') }}">Forgot password?</a>
            </div>
        </form>
    </div>
</body>
</html>

