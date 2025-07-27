@extends('layout.app')

@section('title', 'Give Feedback')
@vite('resources/css/feedback.css')

@section('content')
<div class="container">

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert-success" id="successMessage" style="background-color: #d4edda; color: #155724; padding: 1rem; margin-bottom: 1rem; border-radius: 5px;">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function () {
                const message = document.getElementById('successMessage');
                if (message) {
                    message.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif

    {{-- Feedback form --}}
    <form action="{{ route('customer.submitFeedback', ['order' => $order->id, 'product' => $product->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="customer_id" value="{{ session('customer_id') }}">

        <div class="form-group">
            <label for="rating">Rating (1 to 5)</label><br>
            <select name="rating" id="rating" required>
                <option value="">-- Choose Rating --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <br>

        <div class="form-group">
            <label for="comment">Comment</label><br>
            <textarea name="comment" id="comment" rows="5" required style="width:100%; padding:1rem;"></textarea>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Submit Feedback</button>
    </form>
</div>
@endsection
