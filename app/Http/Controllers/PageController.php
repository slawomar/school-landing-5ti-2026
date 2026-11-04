<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function showRecruitment()
    {
        $filePath = 'editable_pages/recruitment.html';

        $content = Storage::exists($filePath) 
            ? Storage::get($filePath) 
            : '<h2>Rekrutacja</h2><p>Treść do edycji...</p>';

        return view('pages.recruitment', [
            'content' => $content
        ]);
    }

    public function updatePage(Request $request)
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('admin')) {
            return response()->json([
                'success' => false, 
                'message' => 'Brak uprawnień administratora.'
            ], 403);
        }

        $content = $request->input('content');

        if (!$content) {
            return response()->json([
                'success' => false, 
                'message' => 'Brak treści do zapisu.'
            ], 422);
        }

        Storage::put('editable_pages/recruitment.html', $content);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Zapisano zmiany pomyślnie!'
            ]);
        }

        return back()->with('success', 'Zapisano zmiany!');
    }

    public function uploadFile(Request $request)
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('admin')) {
            return response()->json([
                'success' => false, 
                'message' => 'Brak uprawnień.'
            ], 403);
        }

        $request->validate([
            'file' => 'required|file|max:20480',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            
            return response()->json([
                'success' => true,
                'url' => Storage::url($path)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Błąd przesyłania pliku.'], 400);
    }
}