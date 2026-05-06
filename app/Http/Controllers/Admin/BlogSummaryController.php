// app/Http/Controllers/Admin/BlogSummaryController.php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogSummaryRequest;
use App\Models\BlogSummary;
use App\Services\PortfolioContentManager;
use Illuminate\Http\RedirectResponse;

class BlogSummaryController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function store(StoreBlogSummaryRequest $request): RedirectResponse
    {
        $this->contentManager->createBlogSummary($request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'blog'])
            ->with('success', 'ブログ概要を登録しました。');
    }

    public function update(StoreBlogSummaryRequest $request, BlogSummary $blogSummary): RedirectResponse
    {
        $this->contentManager->updateBlogSummary($blogSummary, $request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'blog'])
            ->with('success', 'ブログ概要を更新しました。');
    }

    public function destroy(BlogSummary $blogSummary): RedirectResponse
    {
        $this->contentManager->deleteBlogSummary($blogSummary);
        return redirect()
            ->route('admin.contents.index', ['tab' => 'blog'])
            ->with('success', 'ブログ概要を削除しました。');
    }
}