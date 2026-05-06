// app/Http/Controllers/Admin/TechStackController.php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechStackRequest;
use App\Services\TechStackManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TechStackController extends Controller
{
    public function __construct(
        private readonly TechStackManager $techStackManager
    ) {}

    public function index(): View
    {
        $stacks = $this->techStackManager->getAllStacks();
        return view('admin.techstack.index', compact('stacks'));
    }

    public function update(StoreTechStackRequest $request): RedirectResponse
    {
        $this->techStackManager->updateSelection($request->validated()['stacks']);
        return redirect()
            ->route('admin.techstack.index')
            ->with('success', '技術スタックの選択を更新しました。');
    }
}