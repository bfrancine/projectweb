<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $fillable = [
        'species_id',
        'owner_id',
        'location',
        'status',
        'price',
        'photo',
        'size'
    ];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function updates()
    {
        return $this->hasMany(TreeHistory::class);
    }
}
