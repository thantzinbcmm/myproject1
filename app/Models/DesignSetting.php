// app/Models/DesignSetting.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignSetting extends Model
{
    protected $table = 'design_settings';

    protected $fillable = [
        'theme',
        'color_scheme',
        'font_style',
    ];

    public const THEMES        = ['simple', 'modern', 'colorful'];
    public const COLOR_SCHEMES = ['blue', 'green', 'red', 'purple', 'orange', 'gray'];
    public const FONT_STYLES   = ['Roboto', 'Noto Sans JP', 'Poppins', 'Montserrat', 'Open Sans'];
}