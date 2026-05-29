<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificates extends Model
{
    use HasFactory;

    protected $table = 'certificates';

    protected $fillable = [
        'j_id',
        'title',
        'img',
        'ip_address',
        'active',
    ];
}
