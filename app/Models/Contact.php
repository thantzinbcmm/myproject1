// app/Models/Contact.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contents_contact';

    protected $fillable = [
        'type',
        'value',
    ];

    public const TYPES = ['email', 'phone', 'twitter', 'github', 'linkedin', 'other'];
}