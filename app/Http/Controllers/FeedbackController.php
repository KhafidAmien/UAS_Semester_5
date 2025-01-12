<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Feedback::create($validated);

        return back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}


