<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'birthday', 'occupations', 'img', 'nickname', 'portrayed'];

    protected $hidden = ['pivot'];

    protected $casts = [
        'occupations' => 'array'
    ];

    public function quotes()
    {
        return $this->morphToMany(
            Quote::class,
            'model',
            'model_has_quotes',
            'model_id',
            'quote_id'
        );
    }

    public function episodes()
    {
        return $this->belongsToMany(
            Episode::class,
            'episode_has_characters',
            'episode_id',
            'character_id'
        );
    }

    public function scopeName($query, $value)
    {
        if (!empty($value)) {
            return $query->where('name', 'LIKE', '%' . $value . '%');
        }
    }
}
