<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $slug = $request->query('slug');
        $query = DB::table('photos');

        if ($slug) {
            $query->whereRaw("EXISTS (
                SELECT 1 
                FROM JSON_TABLE(photos.labels, '$[*]' COLUMNS (val VARCHAR(500) PATH '$')) AS j 
                WHERE LOWER(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                        j.val,
                        ' ', '-'),
                        'ą', 'a'), 'ć', 'c'), 'ę', 'e'), 'ł', 'l'), 'ń', 'n'), 'ó', 'o'), 'ś', 's'), 'ź', 'z'), 'ż', 'z'),
                        'Ą', 'a'), 'Ć', 'c'), 'Ę', 'e'), 'Ł', 'l'), 'Ń', 'n'), 'Ó', 'o'), 'Ś', 's'), 'Ź', 'z'), 'Ż', 'z')
                ) = ?
            )", [$slug]);
        }

        $all_photos = $query->orderBy('updated_at', 'desc')->get();

        return view('pages.gallery2', compact('all_photos'));
    }

    public function create()
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
            abort(403);
        }

        return view('pages.gallery-create');
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
            abort(403);
        }

        $request->validate([
            'label'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'photos'       => 'required|array|min:1',
            'photos.*'     => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ], [
            'label.required'   => 'Nazwa labela / albumu jest wymagana.',
            'photos.required'  => 'Musisz dodać przynajmniej jedno zdjęcie.',
            'photos.min'       => 'Musisz dodać przynajmniej jedno zdjęcie.',
            'photos.*.image'   => 'Przesłany plik musi być obrazkiem.',
        ]);

        $labelName = trim($request->input('label'));
        $description = $request->input('description');

        $labelsJson = json_encode([$labelName], JSON_UNESCAPED_UNICODE);

        foreach ($request->file('photos') as $file) {
            $pathOnDisk = $file->store('gallery', 'public');
            $dbPath = 'storage/' . $pathOnDisk;

            DB::table('photos')->insert([
                'path'        => $dbPath,
                'description' => $description,
                'labels'      => $labelsJson,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        return redirect()->route('gallery.store')->with('success', 'Nowy label oraz zdjęcia zostały pomyślnie dodane!');
    }

    public function edit($slug)
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
            abort(403);
        }

        // Pobieramy zdjęcia dopasowane po slugu (Twoje zapytanie)
        $photos = DB::table('photos')
            ->whereRaw("
                LOWER(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                        JSON_UNQUOTE(JSON_EXTRACT(photos.labels, '$[0]')),
                        ' ', '-'),
                        'ą', 'a'), 'ć', 'c'), 'ę', 'e'), 'ł', 'l'), 'ń', 'n'), 'ó', 'o'), 'ś', 's'), 'ź', 'z'), 'ż', 'z'),
                        'Ą', 'a'), 'Ć', 'c'), 'Ę', 'e'), 'Ł', 'l'), 'Ń', 'n'), 'Ó', 'o'), 'Ś', 's'), 'Ź', 'z'), 'Ż', 'z')
                ) = ?
            ", [$slug])
            ->get();

        if ($photos->isEmpty()) {
            abort(404);
        }

        $firstPhotoLabels = json_decode($photos->first()->labels, true);
        $labelName = is_array($firstPhotoLabels) ? $firstPhotoLabels[0] : $photos->first()->labels;

        return view('pages.gallery-edit', [
            'label'  => $labelName,
            'slug'   => $slug,
            'photos' => $photos
        ]);
    }

    public function update(Request $request, $slug)
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
            abort(403);
        }

        $request->validate([
            'label'        => 'required|string|max:255',
            'new_photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        // Pobieramy zdjęcia do edycji za pomocą Twojego zapytania SQL
        $existingPhotos = DB::table('photos')
            ->whereRaw("
                LOWER(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                        JSON_UNQUOTE(JSON_EXTRACT(photos.labels, '$[0]')),
                        ' ', '-'),
                        'ą', 'a'), 'ć', 'c'), 'ę', 'e'), 'ł', 'l'), 'ń', 'n'), 'ó', 'o'), 'ś', 's'), 'ź', 'z'), 'ż', 'z'),
                        'Ą', 'a'), 'Ć', 'c'), 'Ę', 'e'), 'Ł', 'l'), 'Ń', 'n'), 'Ó', 'o'), 'Ś', 's'), 'Ź', 'z'), 'Ż', 'z')
                ) = ?
            ", [$slug])
            ->get();

        if ($existingPhotos->isEmpty()) {
            abort(404);
        }

        $firstPhotoLabels = json_decode($existingPhotos->first()->labels, true);
        $oldLabel = is_array($firstPhotoLabels) ? $firstPhotoLabels[0] : $existingPhotos->first()->labels;
        $newLabel = trim($request->input('label'));

        // 1. Usuwanie zaznaczonych zdjęć
        if ($request->has('delete_photos') && is_array($request->delete_photos)) {
            foreach ($request->delete_photos as $photoId) {
                $photo = DB::table('photos')->where('id', $photoId)->first();
                if ($photo) {
                    $relativePath = str_replace('storage/', '', $photo->path);
                    if (Storage::disk('public')->exists($relativePath)) {
                        Storage::disk('public')->delete($relativePath);
                    }
                    DB::table('photos')->where('id', $photoId)->delete();
                }
            }
        }

        // 2. Aktualizacja nazwy labela
        $newLabelsJson = json_encode([$newLabel], JSON_UNESCAPED_UNICODE);
        if ($oldLabel !== $newLabel) {
            foreach ($existingPhotos as $photo) {
                DB::table('photos')->where('id', $photo->id)->update([
                    'labels'     => $newLabelsJson,
                    'updated_at' => now(),
                ]);
            }
        }

        // 3. Dodanie nowych zdjęć
        if ($request->hasFile('new_photos')) {
            foreach ($request->file('new_photos') as $file) {
                $pathOnDisk = $file->store('gallery', 'public');
                $dbPath = 'storage/' . $pathOnDisk;

                DB::table('photos')->insert([
                    'path'       => $dbPath,
                    'labels'     => $newLabelsJson,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $newSlug = Str::slug($newLabel);

        return redirect('/gallery2?slug=' . $newSlug)->with('success', 'Album został zaktualizowany!');
    }

    public function destroy($slug)
    {
        if (!auth()->check() || !auth()->user()->hasMinRole('editor')) {
            abort(403);
        }

        // Pobieramy zdjęcia przed usunięciem (używając Twojego zapytania)
        $photos = DB::table('photos')
            ->whereRaw("
                LOWER(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                        JSON_UNQUOTE(JSON_EXTRACT(photos.labels, '$[0]')),
                        ' ', '-'),
                        'ą', 'a'), 'ć', 'c'), 'ę', 'e'), 'ł', 'l'), 'ń', 'n'), 'ó', 'o'), 'ś', 's'), 'ź', 'z'), 'ż', 'z'),
                        'Ą', 'a'), 'Ć', 'c'), 'Ę', 'e'), 'Ł', 'l'), 'Ń', 'n'), 'Ó', 'o'), 'Ś', 's'), 'Ź', 'z'), 'Ż', 'z')
                ) = ?
            ", [$slug])
            ->get();

        if ($photos->isEmpty()) {
            abort(404);
        }

        // Usuwamy pliki z dysku
        foreach ($photos as $photo) {
            $relativePath = str_replace('storage/', '', $photo->path);
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }

        // Usuwamy rekordy z bazy
        DB::table('photos')
            ->whereRaw("
                LOWER(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                    REPLACE(
                        JSON_UNQUOTE(JSON_EXTRACT(photos.labels, '$[0]')),
                        ' ', '-'),
                        'ą', 'a'), 'ć', 'c'), 'ę', 'e'), 'ł', 'l'), 'ń', 'n'), 'ó', 'o'), 'ś', 's'), 'ź', 'z'), 'ż', 'z'),
                        'Ą', 'a'), 'Ć', 'c'), 'Ę', 'e'), 'Ł', 'l'), 'Ń', 'n'), 'Ó', 'o'), 'Ś', 's'), 'Ź', 'z'), 'Ż', 'z')
                ) = ?
            ", [$slug])
            ->delete();

        return redirect('/gallery')->with('success', 'Cały album oraz jego zdjęcia zostały usunięte!');
    }
}