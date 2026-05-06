// app/Http/Controllers/Admin/ProjectController.php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Services\PortfolioContentManager;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $this->contentManager->createProject($request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'projects'])
            ->with('success', 'プロジェクトを登録しました。');
    }

    public function update(StoreProjectRequest $request, Project $project): RedirectResponse
    {
        $this->contentManager->updateProject($project, $request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'projects'])
            ->with('success', 'プロジェクトを更新しました。');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->contentManager->deleteProject($project);
        return redirect()
            ->route('admin.contents.index', ['tab' => 'projects'])
            ->with('success', 'プロジェクトを削除しました。');
    }
}