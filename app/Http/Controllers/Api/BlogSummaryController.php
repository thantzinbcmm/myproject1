// app/Http/Controllers/Api/BlogSummaryController.php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogSummaryRequest;
use App\Models\BlogSummary;
use App\Services\PortfolioContentManager;
use Illuminate\Http\JsonResponse;

class BlogSummaryController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->contentManager->getAllBlogSummaries(),
        ]);
    }

    public function store(StoreBlogSummaryRequest $request): JsonResponse
    {
        $blog = $this->contentManager->createBlogSummary($request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => ['id' => $blog->id],
        ], 201);
    }

    public function update(StoreBlogSummaryRequest $request, BlogSummary $blogSummary): JsonResponse
    {
        $updated = $this->contentManager->updateBlogSummary($blogSummary, $request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => $updated,
        ]);
    }

    public function destroy(BlogSummary $blogSummary): JsonResponse
    {
        $this->contentManager->deleteBlogSummary($blogSummary);
        return response()->json(['status' => 'success']);
    }
}