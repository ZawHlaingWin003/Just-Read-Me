<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function getAllGenres()
    {
        $genres = Genre::all();

        return GenreResource::collection($genres);
    }

    public function index()
    {
        if (request()->page) {

            $sortField = request('sort_field', 'id');

            // ကောက်ရိုးပုံထဲက အပ်ရှာတဲ့နည်း
            if (!in_array($sortField, ['id', 'name', 'slug', 'created_at'])) {
                $sortField = 'created_at';
            }

            $sortDirection = request('sort_direction', 'desc');
            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }

            $search_params = array_filter(request()->only([
                'name',
                'slug',
                'created_at'
            ]));


            $genres = Genre::when(count($search_params) > 0, function ($query) use ($search_params) {
                foreach ($search_params as $column => $value) {
                    $query->where($column, 'like', '%' . $value . '%');
                }
            })->when(request('search'), function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('slug', 'like', '%' . request('search') . '%')
                        ->orWhere('created_at', 'like', '%' . request('search') . '%');
                });
            })->orderBy($sortField, $sortDirection)->paginate(request('per_page'));
        } else {
            $genres = Genre::latest()->get();
        }

        return GenreResource::collection($genres);
    }

    public function store(StoreGenreRequest $request)
    {
        $genre = Genre::create([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Genre::class, 'slug', $request->name)
        ]);

        return new GenreResource($genre);
    }

    public function show(Genre $genre)
    {
        return new GenreResource($genre);
    }

    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->update([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Genre::class, 'slug', $request->name)
        ]);

        return new GenreResource($genre);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->noContent();
    }

    public function bulkDelete(Request $request)
    {
        // return $request->all();
        // return request()->all();
        Genre::destroy(request()->ids);

        return response()->noContent();
    }

    public function checkSlug(Request $request)
    {
        $name = $request->name ? $request->name : '';
        $slug = SlugService::createSlug(Genre::class, 'slug', $name);
        return response()->json([
            'slug' => $slug
        ]);
    }
}
