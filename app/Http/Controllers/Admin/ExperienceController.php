// app/Http/Controllers/Admin/ExperienceController.php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Models\Experience;
use App\Services\PortfolioContentManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function index(): View
    {
        $experiences = $this->contentManager->getAllExperiences();
        $projects    = $this->contentManager->getAllProjects();
        $blogs       = $this->contentManager->getAllBlogSummaries();
        $contacts    = $this->contentManager->getAllContacts();

        return view('admin.contents.index', compact(
            'experiences', 'projects', 'blogs', 'contacts'
        ));
    }

    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        $this->contentManager->createExperience($request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'experience'])
            ->with('success', '経歴情報を登録しました。');
    }

    public function update(StoreExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $this->contentManager->updateExperience($experience, $request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'experience'])
            ->with('success', '経歴情報を更新しました。');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $this->contentManager->deleteExperience($experience);
        return redirect()
            ->route('admin.contents.index', ['tab' => 'experience'])
            ->with('success', '経歴情報を削除しました。');
    }
}