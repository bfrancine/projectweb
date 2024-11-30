<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    protected $table = 'species';
    protected $fillable = ['commercial_name', 'scientific_name'];
}

