<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Genre;
use App\Models\Media;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();

        return BookResource::collection($books);
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'author_id' => $request->author_id,
            'published_at' => now(),
        ]);

        $genres = Genre::find($request->genres_id);
        $book->genres()->attach($genres);

        if (count(request()->cover) > 0) {
            foreach (request()->file('cover') as $cover) {
                $filename = time() . '_' . uniqid() . request()->slug . '.' . $cover->getClientOriginalExtension();

                $cover->storeAs('media/books/' . $request->slug . '/covers', $filename);

                Media::create([
                    'filepath' => $filename,
                    'filetype' => $cover->extension(),
                    'filesize' => $cover->getSize(),
                    'mediable_id' => $book->id,
                    'mediable_type' => Book::class,
                    'remark' => 'book_cover'
                ]);
            }
        }

        if (request()->hasFile('pdf_file')) {
            $pdf_file = request()->file('pdf_file');
            $filename = time() . '_' . uniqid() . request()->slug . '.' . $pdf_file->getClientOriginalExtension();

            $pdf_file->storeAs('media/books/' . $request->slug . '/pdf_files', $filename);

            Media::create([
                'filepath' => $filename,
                'filetype' => $pdf_file->extension(),
                'filesize' => $pdf_file->getSize(),
                'mediable_id' => $book->id,
                'mediable_type' => Book::class,
                'remark' => 'book_pdf'
            ]);
        }

        return new BookResource($book);
    }

    public function show(Book $book)
    {
        //
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    public function destroy(Book $book)
    {
        //
    }

    public function checkSlug()
    {
        $name = request()->name ? request()->name : '';
        $slug = SlugService::createSlug(Book::class, 'slug', $name);
        return response()->json([
            'slug' => $slug
        ]);
    }
}
