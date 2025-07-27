<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Login Type</title>
    @vite('resources/css/login-choice.css')
</head>
<body>
    <div class="login-choice-container">
        <h1 class="login-choice-title">Login As</h1>
        <div class="login-choice-buttons">
            <a href="{{ route('customer.login') }}" class="customer-btn">Customer</a>
            <a href="{{ route('seller.login') }}" class="seller-btn">Seller</a>
        </div>
    </div>
</body>
</html>

</body>
</html>
