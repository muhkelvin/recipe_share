<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'ingredients', 'instructions', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(RecipeRating::class);
    }

    public function comments()
    {
        return $this->hasMany(RecipeComment::class);
    }

    public function collections()
    {
        return $this->belongsToMany(RecipeCollection::class, 'collection_recipe');
    }
}
