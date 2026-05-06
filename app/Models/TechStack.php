// app/Models/TechStack.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechStack extends Model
{
    protected $table = 'tech_stack_selection';

    protected $fillable = [
        'stack_name',
        'selected',
    ];

    protected $casts = [
        'selected' => 'boolean',
    ];
}