// app/Http/Controllers/Api/ProjectController.php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Services\PortfolioContentManager;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->contentManager->getAllProjects(),
        ]);
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->contentManager->createProject($request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => ['id' => $project->id],
        ], 201);
    }

    public function update(StoreProjectRequest $request, Project $project): JsonResponse
    {
        $updated = $this->contentManager->updateProject($project, $request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => $updated,
        ]);
    }

    public function destroy(Project $project): JsonResponse
    {
        $this->contentManager->deleteProject($project);
        return response()->json(['status' => 'success']);
    }
}