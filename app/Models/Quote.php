<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['quote'];

    protected $hidden = ['pivot'];

    public function character()
    {
        return $this->morphedByMany(
            Character::class, 'model',
            'model_has_quotes',
            'model_id',
            'quote_id');
    }

    public function episode()
    {
        return $this->morphedByMany(
            Episode::class,
            'model_has_quotes',
            'model_id',
            'quote_id'
        );
    }

    public function scopeCharacter($query, $value)
    {
        if (!empty($value)) {
            return $query->wherehas('character', function ($q) use($value){
                $q->where('name', 'LIKE', '%' . $value . '%');
            });
        }
    }
}
