<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function step1()
    {
        return view('kuiz.step1');
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'mood' => 'required|string',
            'goal' => 'required|string'
        ]);

        $prefs = session('quiz_prefs', []);
        $prefs['mood'] = $request->mood;
        $prefs['goal'] = $request->goal;
        session(['quiz_prefs' => $prefs]);

        return redirect()->route('quiz.step2');
    }

    public function step2()
    {
        return view('kuiz.step2');
    }

    public function processStep2(Request $request)
    {
        $request->validate([
            'genres' => 'required|array'
        ]);

        $prefs = session('quiz_prefs', []);
        $prefs['genres'] = $request->genres;
        session(['quiz_prefs' => $prefs]);

        return redirect()->route('quiz.step3');
    }

    public function step3()
    {
        return view('kuiz.step3');
    }

    public function processStep3(Request $request)
    {
        $request->validate([
            'pacing' => 'required|string',
            'length' => 'required|string'
        ]);

        $prefs = session('quiz_prefs', []);
        $prefs['pacing'] = $request->pacing;
        $prefs['length'] = $request->length;

        // Save to database
        $user = Auth::user();
        $user->preferences = $prefs;
        $user->save();

        // Clear session
        $request->session()->forget('quiz_prefs');

        return redirect()->route('myshelf');
    }
}
