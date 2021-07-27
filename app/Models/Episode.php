<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'air_date'];

    protected $hidden = ['pivot'];

    public function characters()
    {
        return $this->belongsToMany(
            Character::class,
            'episode_has_characters',
            'episode_id',
            'character_id'
        );
    }

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
}
