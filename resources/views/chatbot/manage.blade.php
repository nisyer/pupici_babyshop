<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Chatbot</title>
    @vite('resources/css/chatbot.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="chatbot-container">
        <div class="header">

         <a href="{{ route('dashboard') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back
        </a>
            <h2><i class="fas fa-robot"></i> Manage Chatbot FAQ</h2>
            <a href="{{ route('addfaq') }}" class="add-btn"><i class="fas fa-plus-circle"></i> Add FAQ</a>
        </div>

        {{-- Display success message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chatbots as $index => $chatbot)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $chatbot->question }}</td>
                        <td>{{ $chatbot->answer }}</td>
                        <td class="actions">
                            <a href="{{ route('chatbot.edit', $chatbot->id) }}" class="edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('chatbot.delete', $chatbot->id) }}" class="delete"
                               onclick="return confirm('Are you sure to delete this FAQ?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

