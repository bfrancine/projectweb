<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;

    protected $fillable = ['size', 'location', 'price', 'photo_path', 'species_id', 'state_tree_id'];

    public function specie()
    {
        return $this->belongsTo(Specie::class, 'species_id');
    }

    public function state()
    {
        return $this->belongsTo(StateTree::class, 'state_tree_id');
    }
}
