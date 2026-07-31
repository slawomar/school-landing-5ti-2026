<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'content'     => 'nullable|string',
        'category'    => 'nullable|string|max:255',
        'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $pathOnDisk = $request->file('thumbnail')->store('thumbnails', 'public');
        
        $thumbnailPath = 'storage/' . $pathOnDisk;
    }

    $slug = Str::slug($validated['title']);
    if (DB::table('articles')->where('slug', $slug)->exists()) {
        $slug = $slug . '-' . time();
    }

    DB::table('articles')->insert([
        'title'       => $validated['title'],
        'slug'        => $slug,
        'category'    => $validated['category'] ?? 'Komunikat',
        'thumbnail'   => $thumbnailPath,
        'description' => $validated['description'] ?? '',
        'content'     => $validated['content'] ?? '',
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);

    return back()->with('success', 'Artykuł został pomyślnie dodany!');
}
public function destroy($slug)
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
            abort(403);
        }

        $article = DB::table('articles')->where('slug', $slug)->first();

        if ($article) {
            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            DB::table('articles')->where('slug', $slug)->delete();
        }

        return back()->with('success', 'Artykuł został pomyślnie usunięty!');
    }
    public function edit($slug)
{
    if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
        abort(403);
    }

    $article = DB::table('articles')->where('slug', $slug)->first();

    if (!$article) {
        abort(404);
    }

    return view('pages.article-edit', compact('article'));
}

public function update(Request $request, $slug)
{
    if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
        abort(403);
    }

    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'content'     => 'nullable|string',
        'category'    => 'nullable|string|max:255',
        'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $article = DB::table('articles')->where('slug', $slug)->first();

    if (!$article) {
        abort(404);
    }

    $thumbnailPath = $article->thumbnail;

    if ($request->has('remove_thumbnail') && $article->thumbnail) {
        $relativePath = str_replace('storage/', '', $article->thumbnail);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
        $thumbnailPath = null;
    }

    if ($request->hasFile('thumbnail')) {
        if ($article->thumbnail) {
            $oldRelativePath = str_replace('storage/', '', $article->thumbnail);
            if (Storage::disk('public')->exists($oldRelativePath)) {
                Storage::disk('public')->delete($oldRelativePath);
            }
        }

        $pathOnDisk = $request->file('thumbnail')->store('thumbnails', 'public');
        
        $thumbnailPath = 'storage/' . $pathOnDisk;
    }

    $newSlug = $article->slug;
    if ($validated['title'] !== $article->title) {
        $newSlug = Str::slug($validated['title']);
        if (DB::table('articles')->where('slug', $newSlug)->where('slug', '!=', $slug)->exists()) {
            $newSlug = $newSlug . '-' . time();
        }
    }

    DB::table('articles')->where('slug', $slug)->update([
        'title'       => $validated['title'],
        'slug'        => $newSlug,
        'category'    => $validated['category'] ?? 'Komunikat',
        'thumbnail'   => $thumbnailPath,
        'description' => $validated['description'] ?? '',
        'content'     => $validated['content'] ?? '',
        'updated_at'  => now(),
    ]);

    return redirect()->route('articles.show', $newSlug)->with('success', 'Artykuł został zaktualizowany!');
}
}