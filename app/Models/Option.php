<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['option', 'counter', 'survey_id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
