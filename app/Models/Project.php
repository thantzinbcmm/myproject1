// app/Models/Project.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'contents_projects';

    protected $fillable = [
        'name',
        'description',
        'tech_stack',
        'period_from',
        'period_to',
    ];

    protected $casts = [
        'period_from' => 'date',
        'period_to'   => 'date',
    ];
}