<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name'];

    public function cashs()
    {
        return $this->hasMany(Cash::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Assets::class);
    }
}
