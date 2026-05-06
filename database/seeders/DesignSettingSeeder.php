// database/seeders/DesignSettingSeeder.php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('design_settings')->count() === 0) {
            DB::table('design_settings')->insert([
                'theme'        => 'simple',
                'color_scheme' => 'blue',
                'font_style'   => 'Roboto',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}