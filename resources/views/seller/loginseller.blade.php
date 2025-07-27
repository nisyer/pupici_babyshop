<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Login</title>
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
        <form method="POST" action="{{ route('seller.login.submit') }}">

            @csrf
            <label for="staff_id">Staff ID:</label>
            <input type="text" name="staff_id" id="staff_id" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html> 