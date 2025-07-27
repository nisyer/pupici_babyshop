<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Feedback</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> {{-- Guna CSS dashboard --}}
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .main-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .feedback-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .feedback-table th,
        .feedback-table td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .feedback-table th {
            background-color: #e0f0ff;
            font-weight: bold;
        }

        .no-feedback {
            text-align: center;
            margin-top: 2rem;
            font-style: italic;
            color: #888;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <a href="{{ route('seller.dashboard') }}" class="back-button">← Back</a>

    <div class="main-content">
        <h2 class="section-title">Customer Feedback</h2>

        <p>Feedback Count: {{ isset($feedbacks) ? count($feedbacks) : 'NOT FOUND' }}</p>

        @if(count($feedbacks) > 0)
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Rating</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->customer->name ?? 'N/A' }}</td>
                            <td>{{ $feedback->product->name ?? 'N/A' }}</td>
                            <td>{{ $feedback->rating }}</td>
                            <td>{{ $feedback->comment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-feedback">No feedback available.</p>
        @endif
    </div>
</body>
</html>

