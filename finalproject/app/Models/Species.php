<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = [
        'commercial_name',
        'scientific_name'
    ];

    public function trees()
    {
        return $this->hasMany(Tree::class);
    }
}
