<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleAuthor extends Model
{
    protected $fillable = ['position', 'first_name', 'last_name', 'designation', 'affiliation', 'is_corresponding', 'sup_number'];
    protected $casts = ['is_corresponding' => 'boolean', 'sup_number' => 'integer'];

    public function article()
    {
        return $this->belongsTo(articles::class, 'article_id');
    }
}
