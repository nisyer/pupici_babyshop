<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - PUPICI</title>
    @vite('resources/css/customerlogin.css')
</head>
<body>
    <div class="login-container">
        <div class="login-logo-wrapper">
            <img src="{{ asset('images/pupici-logo.png') }}" alt="PUPICI Logo" style="width: 150px;">
        </div>
        
        <h2>Forgot Password</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('customer.password.email') }}">
            @csrf
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}">
            
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <button type="submit">Send Reset Link</button>
            
            <div class="register-section">
                <span>Remember your password?</span>
                <a href="{{ route('customer.login') }}" class="back-to-login-link">Back to Login</a>
            </div>
        </form>
    </div>
</body>
</html> 