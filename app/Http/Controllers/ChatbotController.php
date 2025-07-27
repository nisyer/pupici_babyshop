<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;

class ChatbotController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Chatbot::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return redirect()->route('chatbot.manage')->with('success', 'FAQ added successfully!');
    }

    public function index()
    {
        $chatbots = Chatbot::all();
        return view('chatbot.manage', compact('chatbots'));
    }

public function create()
{
    return view('chatbot.addfaq');
}



    public function destroy($id)
    {
        $chatbot = Chatbot::findOrFail($id);
        $chatbot->delete();

        return redirect()->route('chatbot.manage')->with('success', 'FAQ deleted successfully.');
    }

    public function edit($id)
{
    $chatbot = Chatbot::findOrFail($id); // cari data berdasarkan ID
    return view('chatbot.editfaq', compact('chatbot')); // hantar ke view edit
}

public function update(Request $request, $id)
{
    $request->validate([
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
    ]);

    $chatbot = Chatbot::findOrFail($id);
    $chatbot->question = $request->question;
    $chatbot->answer = $request->answer;
    $chatbot->save();

    return redirect()->route('chatbot.manage')->with('success', 'FAQ updated successfully!');
}

public function show()
    {
        $questions = Chatbot::all(); // fetch all questions
        return view('chatbot', compact('questions'));
    }

    public function getAnswer(Request $request)
    {
        $questionId = $request->input('question_id');
        $chat = Chatbot::find($questionId);

        return response()->json([
            'answer' => $chat ? $chat->answer : 'Sorry, no answer found.'
        ]);
    }

     public function getQuestions()
    {
        $questions = Chatbot::select('id', 'question', 'answer')->get();

        return response()->json($questions);
    }

}



