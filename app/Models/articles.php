<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articles extends Model
{
    use HasFactory;
    protected $table = 'article';

    public function publicationAuthors()
    {
        return $this->hasMany(ArticleAuthor::class, 'article_id')->orderBy('position');
    }
}
