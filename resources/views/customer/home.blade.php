@extends('layout.app')

@section('title', 'Customer Home')

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  @vite('resources/css/homepage.css')
  @vite('resources/css/cart.css')
@endsection

@section('content')

  <main class="product-list">
    <div class="products">
      @foreach ($products as $product)
        <div class="product-card">
          <a href="{{ route('product.show', $product->id) }}">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
          </a>
          <p>RM{{ number_format($product->price, 2) }}</p>
        </div>
      @endforeach
    </div>
  </main>


  {{-- Chatbot --}}
  <div id="chatbot-btn" style="position:fixed;bottom:32px;right:32px;z-index:1000;">
    <button onclick="openChatbot()" style="background:#357ab7;color:#fff;border:none;border-radius:50%;width:60px;height:60px;box-shadow:0 2px 8px rgba(52,152,219,0.15);font-size:2rem;cursor:pointer;">
      <i class="fas fa-comment-dots"></i>
    </button>
  </div>
  <div id="chatbot-window" style="display:none;position:fixed;bottom:100px;right:32px;width:340px;max-width:90vw;background:#fff;border-radius:1rem;box-shadow:0 4px 24px rgba(52,152,219,0.15);z-index:1001;overflow:hidden;">
    <div style="background:#357ab7;color:#fff;padding:1rem 1.2rem;font-weight:600;display:flex;justify-content:space-between;align-items:center;">
      <span>Chatbot</span>
      <button onclick="closeChatbot()" style="background:none;border:none;color:#fff;font-size:1.3rem;cursor:pointer;">&times;</button>
    </div>
    <div id="chatbot-content" style="padding:1.2rem;max-height:320px;overflow-y:auto;font-size:1rem;">
      <div id="chatbot-loading">Loading questions...</div>
      <ul id="chatbot-questions" style="list-style:none;padding:0;margin:0;display:none;"></ul>
      <div id="chatbot-answer" style="margin-top:1.2rem;color:#444;"></div>
      <div id="chatbot-history"></div>
    </div>
  </div>
  <style>
    #chatbot-history {
      display: flex;
      flex-direction: column;
      gap: 0.2rem;
      min-height: 60px;
      max-height: 220px;
      overflow-y: auto;
      margin-bottom: 0.5rem;
    }
  </style>
  <script>
    // Chatbot script kekal sepenuhnya
    let chatbotHistory = [];
    function openChatbot() {
      document.getElementById('chatbot-window').style.display = 'block';
      document.getElementById('chatbot-btn').style.display = 'none';
      fetchChatbotQuestions();
    }
    function closeChatbot() {
      document.getElementById('chatbot-window').style.display = 'none';
      document.getElementById('chatbot-btn').style.display = 'block';
      document.getElementById('chatbot-answer').innerHTML = '';
      document.getElementById('chatbot-questions').style.display = 'none';
      document.getElementById('chatbot-loading').style.display = 'block';
      document.getElementById('chatbot-history').innerHTML = '';
      chatbotHistory = [];
    }
    function fetchChatbotQuestions() {
      document.getElementById('chatbot-loading').style.display = 'block';
      document.getElementById('chatbot-questions').style.display = 'none';
      document.getElementById('chatbot-answer').innerHTML = '';
      document.getElementById('chatbot-history').innerHTML = '';
      chatbotHistory = [];
      fetch('/customer/chatbot/questions')
        .then(res => res.json())
        .then(data => {
          const ul = document.getElementById('chatbot-questions');
          ul.innerHTML = '';
          data.forEach(q => {
            const li = document.createElement('li');
            li.innerHTML = `<button style='width:100%;text-align:left;background:#f0f8ff;border:none;padding:0.7rem 1rem;margin-bottom:0.5rem;border-radius:0.5rem;cursor:pointer;font-size:1rem;' onclick='chooseChatbotQuestion(${JSON.stringify(q.question)}, ${JSON.stringify(q.answer)})'>${q.question}</button>`;
            ul.appendChild(li);
          });
          document.getElementById('chatbot-loading').style.display = 'none';
          ul.style.display = 'block';
        });
    }
    function chooseChatbotQuestion(question, answer) {
      chatbotHistory.push({from: 'customer', text: question});
      chatbotHistory.push({from: 'bot', text: answer});
      renderChatbotHistory();
    }
    function renderChatbotHistory() {
      const historyDiv = document.getElementById('chatbot-history');
      historyDiv.innerHTML = '';
      chatbotHistory.forEach(msg => {
        const bubble = document.createElement('div');
        bubble.style.maxWidth = '80%';
        bubble.style.marginBottom = '0.7rem';
        bubble.style.padding = '0.7rem 1rem';
        bubble.style.borderRadius = '1.2rem';
        bubble.style.wordBreak = 'break-word';
        if (msg.from === 'customer') {
          bubble.style.background = '#e3f0ff';
          bubble.style.alignSelf = 'flex-end';
          bubble.style.marginLeft = 'auto';
          bubble.style.color = '#357ab7';
        } else {
          bubble.style.background = '#f0f8ff';
          bubble.style.alignSelf = 'flex-start';
          bubble.style.marginRight = 'auto';
          bubble.style.color = '#444';
        }
        bubble.innerText = msg.text;
        historyDiv.appendChild(bubble);
      });
      if (chatbotHistory.length > 0 && chatbotHistory[chatbotHistory.length-1].from === 'bot') {
        const backBtn = document.createElement('button');
        backBtn.innerText = 'Back to questions';
        backBtn.style.background = '#357ab7';
        backBtn.style.color = '#fff';
        backBtn.style.border = 'none';
        backBtn.style.borderRadius = '0.5rem';
        backBtn.style.padding = '0.5rem 1.2rem';
        backBtn.style.marginTop = '0.5rem';
        backBtn.style.cursor = 'pointer';
        backBtn.onclick = () => {
          document.getElementById('chatbot-questions').style.display = 'block';
          document.getElementById('chatbot-answer').innerHTML = '';
          document.getElementById('chatbot-history').innerHTML = '';
          chatbotHistory = [];
        };
        historyDiv.appendChild(backBtn);
        document.getElementById('chatbot-questions').style.display = 'none';
      }
      historyDiv.scrollTop = historyDiv.scrollHeight;
    }
  </script>
@endsection

