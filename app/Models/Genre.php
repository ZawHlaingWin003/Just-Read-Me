<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Genre extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function readable_created_at(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value->diffForHumans()
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->using(BookGenre::class);
    }
}
