<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonsterSightings extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'monster_type',
        'description',
        'latitude',
        'longitude',
        'sighted_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
