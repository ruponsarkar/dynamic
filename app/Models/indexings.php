<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class indexings extends Model
{
    use HasFactory;
    protected $table = 'indexing';
    protected $fillable = [
        'link', // Add this line
        'img',  // Also include other fillable fields if necessary
    ];
}
