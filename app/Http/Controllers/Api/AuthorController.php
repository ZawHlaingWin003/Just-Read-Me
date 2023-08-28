<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Media;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::all();
        return AuthorResource::collection($authors);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Author::class, 'slug', $request->name),
            'biography' => $request->biography
        ]);

        if (request()->hasFile('profile')) {
            $image = request()->file('profile');
            $filename = time() . '_' . uniqid() . request()->slug . '.' . $image->getClientOriginalExtension();

            $image->storeAs('media/authors', $filename);

            Media::create([
                'filepath' => $filename,
                'filetype' => $image->extension(),
                'filesize' => $image->getSize(),
                'mediable_id' => $author->id,
                'mediable_type' => Author::class
            ]);
        }

        return new AuthorResource($author);
    }

    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {

        $author->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'biography' => $request->biography
        ]);

        if (request()->hasFile('profile')) {
            $image = request()->file('profile');
            $filename = time() . '_' . uniqid() . request()->slug . '.' . $image->getClientOriginalExtension();

            $image->storeAs('media/authors', $filename);

            $author->profile->update([
                'filepath' => $filename,
                'filetype' => $image->extension(),
                'filesize' => $image->getSize()
            ]);
        } else {
            unset(request()->profile);
        }

        return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        Storage::delete('media/authors/' . $author->profile?->filepath);
        $author->delete();

        return response()->noContent();
    }

    public function checkSlug(Request $request)
    {
        $name = $request->name ? $request->name : '';
        $slug = SlugService::createSlug(Author::class, 'slug', $name);
        return response()->json([
            'slug' => $slug
        ]);
    }
}
