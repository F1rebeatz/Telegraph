<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function telegraph()
    {
        return $this->hasMany(TelegraphText::class, 'category_id', 'id');
    }
}
