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
        'approved_at',
        'approved_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
