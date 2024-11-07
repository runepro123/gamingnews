<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    
    protected $fillable = ['question'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function totalVotes()
    {
        return $this->options->sum('counter');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
