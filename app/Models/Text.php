<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_text',
        'modified_text',
        'used_tokens',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
