<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add FAQ</title>
    @vite('resources/css/chatbot.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="faq-form-container">
        <h2><i class="fas fa-plus-circle"></i> Add New FAQ</h2>

        <form action="{{ route('chatbot.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" id="question" name="question" placeholder="Enter FAQ question..." required>
            </div>

            <div class="form-group">
                <label for="answer">Answer</label>
                <textarea id="answer" name="answer" rows="4" placeholder="Enter answer here..." required></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Save</button>
                <a href="{{ route('chatbot.manage') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
