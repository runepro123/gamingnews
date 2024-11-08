<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakingNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id', 
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
    

}
