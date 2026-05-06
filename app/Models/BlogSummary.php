// app/Models/BlogSummary.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogSummary extends Model
{
    use HasFactory;

    protected $table = 'contents_blog_summary';

    protected $fillable = [
        'title',
        'summary',
        'url',
    ];
}