<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'published_at' => $this->slug,
            'is_approved' => $this->is_approved,
            'author' => new AuthorResource($this->author),
            'covers' => $this->covers()->where('remark', 'book_cover')->get(),
            'pdf_file' => $this->pdf_file ? asset('media/books/' . $this->slug . '/pdf_files/' . $this->pdf_file()->where('remark', 'book_pdf')->first()->filepath) : null,
            // 'covers' => array_map(function ($cover) {
            //     return $cover->filepath;
            // }, $this->covers)
        ];
    }
}
