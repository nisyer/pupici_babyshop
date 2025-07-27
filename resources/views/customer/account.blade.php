@extends('layout.app')

@section('title', 'My Account')

@section('content')
@vite('resources/css/account.css')

<div class="account-container">
    <div class="container">
        <h2>My Account</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('customer.account.update') }}" method="POST">
            @csrf

            <label>Name:</label>
            <input type="text" name="name" value="{{ $customer->name }}" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ $customer->email }}" required>

            <label>Phone Number:</label>
            <input type="text" name="phone" value="{{ $customer->phone }}" required>

            <label>Address:</label>
            <textarea name="address" required>{{ $customer->address }}</textarea>

            <button type="submit">Update</button>
        </form>
    </div>
</div>
@endsection
