<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register Account</title>
  @vite('resources/css/customerregister.css')
</head>
<body>
  <div class="register-container">
    <h2 class="register-title">Register</h2>
    <form method="POST" action="{{ route('customer.register.submit') }}">
      @csrf
      <label for="name">Name</label>
      <input type="text" name="name" id="name" required>
      
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" required>
      
      <label for="address">Address</label>
      <textarea name="address" id="address" required></textarea>
      
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>
      
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>
      
      <label for="password_confirmation">Confirm Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required>

      <button type="submit">Register</button>
    </form>
    <div class="login-section">
      Already have an account? <a href="{{ route('customer.login') }}">Login here</a>
    </div>
  </div>
</body>
</html>



