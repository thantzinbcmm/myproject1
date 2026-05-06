// database/seeders/TechStackSeeder.php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechStackSeeder extends Seeder
{
    public function run(): void
    {
        $stacks = [
            'React', 'Vue.js', 'Next.js', 'Nuxt.js',
            'Angular', 'Svelte', 'Laravel', 'Django',
            'Node.js', 'Express', 'TypeScript', 'Tailwind CSS',
        ];

        foreach ($stacks as $stack) {
            DB::table('tech_stack_selection')->insertOrIgnore([
                'stack_name' => $stack,
                'selected'   => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}