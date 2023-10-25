<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function telegraph()
    {
        return $this->belongsToMany(TelegraphText::class, 'tag_telegraphs', 'tag_id', 'telegraph_id');
    }
}
