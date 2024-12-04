<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeHistory extends Model
{
    protected $fillable = [
        'tree_id',
        'size',
        'photo'
    ];

    public function tree()
    {
        return $this->belongsTo(Tree::class);
    }
}
