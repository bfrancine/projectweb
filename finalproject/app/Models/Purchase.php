<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'tree_id',
        'purchase_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); //relacion con la tabla user
    }

    public function tree()
    {
        return $this->belongsTo(Tree::class);
    }
}
