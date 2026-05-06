// app/Services/TechStackManager.php
<?php

namespace App\Services;

use App\Models\TechStack;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class TechStackManager
{
    public function getAllStacks(): Collection
    {
        return TechStack::orderBy('stack_name')->get();
    }

    public function getSelectedStacks(): Collection
    {
        return TechStack::where('selected', true)->orderBy('stack_name')->get();
    }

    public function updateSelection(array $selectedIds): void
    {
        // 全件選択解除してから選択済みに更新
        TechStack::query()->update(['selected' => false]);

        if (!empty($selectedIds)) {
            TechStack::whereIn('id', $selectedIds)->update(['selected' => true]);
        }

        Log::info('技術スタック選択を更新しました。', ['selected_ids' => $selectedIds]);
    }

    public function addStack(string $stackName): TechStack
    {
        $stack = TechStack::create([
            'stack_name' => $stackName,
            'selected'   => false,
        ]);
        Log::info('技術スタックを追加しました。', ['stack_name' => $stackName]);
        return $stack;
    }
}