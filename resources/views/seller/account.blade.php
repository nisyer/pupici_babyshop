<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/selleraccount.css')
</head>
<body>
    <div class="account-container">
        <a href="{{ route('seller.dashboard') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <h2>Account Details</h2>

        <form action="{{ route('seller.account.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{ old('name', $seller->name) }}" required>
            </div>
            <div class="form-group">
                <label>Staff ID:</label>
                <input type="text" name="staff_id" value="{{ old('staff_id', $seller->staff_id) }}" readonly>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="text" name="phone" value="{{ old('phone', $seller->phone) }}">
            </div>
            <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <label>Confirm New Password:</label>
                <input type="password" name="password_confirmation">
            </div>
            <button type="submit" class="btn-submit">Update Account</button>
        </form>
    </div>
</body>
</html>
