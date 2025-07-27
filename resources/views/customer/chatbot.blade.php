<!DOCTYPE html>
<html>
<head>
    <title>Chatbot</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 2rem;
            background-color: #f5f8fa;
        }

        .chat-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .question-select {
            width: 100%;
            padding: 0.6rem;
            font-size: 1rem;
            border-radius: 6px;
        }

        .answer-box {
            margin-top: 2rem;
            padding: 1rem;
            background-color: #e0f7fa;
            border-left: 4px solid #007bff;
            border-radius: 6px;
            display: none;
        }
    </style>
</head>
<body>
<div class="chat-container">
    <h2>Select a Question</h2>

    <select id="questionSelect" class="question-select">
        <option value="">-- Choose a question --</option>
        @foreach ($questions as $q)
            <option value="{{ $q->id }}">{{ $q->question }}</option>
        @endforeach
    </select>

    <div class="answer-box" id="answerBox"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#questionSelect').change(function () {
        const questionId = $(this).val();
        if (questionId) {
            $.ajax({
                url: "{{ route('chatbot.answer') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    question_id: questionId
                },
                success: function (data) {
                    $('#answerBox').text(data.answer).fadeIn();
                }
            });
        } else {
            $('#answerBox').fadeOut();
        }
    });
</script>
</body>
</html>
