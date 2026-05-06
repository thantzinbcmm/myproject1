// app/Models/Experience.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'contents_experience';

    protected $fillable = [
        'title',
        'description',
        'period_from',
        'period_to',
    ];

    protected $casts = [
        'period_from' => 'date',
        'period_to'   => 'date',
    ];
}