<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TelegraphText extends Model
{
    use SoftDeletes;
    protected $table = 'telegraph_text';
    protected $guarded = [];
}
