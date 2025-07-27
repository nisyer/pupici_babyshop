<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Report</title>
    
    <style>
        body {
            background: #f0f8ff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #357ab7;
            padding: 8px 14px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .back-button:hover {
            background-color: #285a8c;
        }

        .main-content {
            width: 100%;
            text-align: center;
            margin-top: 80px; /* Push just a bit below the back button */
        }

        .main-content h2 {
            color: #000000ff;
            margin-bottom: 1rem;
        }

        .date-form {
            display: inline-block;
            margin-top: 10px;
        }

        .date-form label {
            margin-right: 10px;
            font-weight: bold;
        }

        .date-form input[type="date"] {
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.4rem;
        }

        .date-form button {
            padding: 0.5rem 1rem;
            background-color: #357ab7;
            color: white;
            border: none;
            border-radius: 0.4rem;
            cursor: pointer;
            font-weight: bold;
            margin-left: 0.5rem;
        }

        .date-form button:hover {
            background-color: #285a8c;
        }
    </style>
</head>
<body>
    <a href="{{ route('seller.dashboard') }}" class="back-button">← Back</a>

    <div class="main-content">
        <h2>Select Date to View Order Report</h2>

        <form action="{{ route('seller.viewOrderReport') }}" method="GET" class="date-form">
            <label for="date">Date:</label>
            <input type="date" name="date" required>
            <button type="submit">View Report</button>
        </form>
    </div>
</body>
</html>
