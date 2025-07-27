<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/registerstaff.css')
    <title>Register Staff</title>
</head>
<body>
    <a href="{{ route('seller.dashboard') }}" class="back-button">← Back </a>
    <div class="register-container">
        <h2>Register New Staff</h2>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<form action="{{ route('seller.registerstaff.submit') }}" method="POST">
    @csrf
    <input type="text" name="staff_id" placeholder="Staff ID">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="phone" placeholder="Phone">
    <input type="password" name="password" placeholder="Password">

    <!-- Dropdown role -->
    <select name="role" required>
        <option value="">Select Role</option>
        <option value="staff">Staff</option>
        <option value="manager">Manager</option>
    </select>

    <!-- Butang Register -->
    <button type="submit">Register</button>
</form>

    </div>
</body>
</html>
