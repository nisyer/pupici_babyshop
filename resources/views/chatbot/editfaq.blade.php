<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit FAQ</title>
    @vite('resources/css/chatbot.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="faq-form-container">
        <h2><i class="fas fa-edit"></i> Edit FAQ</h2>

        <form action="{{ route('chatbot.update', $chatbot->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" id="question" name="question" value="{{ old('question', $chatbot->question) }}" required>
            </div>

            <div class="form-group">
                <label for="answer">Answer</label>
                <textarea id="answer" name="answer" rows="4" required>{{ old('answer', $chatbot->answer) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Update FAQ</button>
                <a href="{{ route('chatbot.manage') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
