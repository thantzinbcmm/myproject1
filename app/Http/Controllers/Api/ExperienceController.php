// app/Http/Controllers/Api/ExperienceController.php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Models\Experience;
use App\Services\PortfolioContentManager;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->contentManager->getAllExperiences(),
        ]);
    }

    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $experience = $this->contentManager->createExperience($request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => ['id' => $experience->id],
        ], 201);
    }

    public function update(StoreExperienceRequest $request, Experience $experience): JsonResponse
    {
        $updated = $this->contentManager->updateExperience($experience, $request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => $updated,
        ]);
    }

    public function destroy(Experience $experience): JsonResponse
    {
        $this->contentManager->deleteExperience($experience);
        return response()->json(['status' => 'success']);
    }
}