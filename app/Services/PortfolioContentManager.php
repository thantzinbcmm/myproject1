// app/Services/PortfolioContentManager.php
<?php

namespace App\Services;

use App\Models\Experience;
use App\Models\Project;
use App\Models\BlogSummary;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class PortfolioContentManager
{
    // ─── Experience ──────────────────────────────────────────────

    public function getAllExperiences(): Collection
    {
        return Experience::orderBy('period_from', 'desc')->get();
    }

    public function createExperience(array $data): Experience
    {
        $experience = Experience::create($data);
        Log::info('経歴情報を登録しました。', ['id' => $experience->id]);
        return $experience;
    }

    public function updateExperience(Experience $experience, array $data): Experience
    {
        $experience->update($data);
        Log::info('経歴情報を更新しました。', ['id' => $experience->id]);
        return $experience->fresh();
    }

    public function deleteExperience(Experience $experience): void
    {
        $id = $experience->id;
        $experience->delete();
        Log::info('経歴情報を削除しました。', ['id' => $id]);
    }

    // ─── Project ──────────────────────────────────────────────────

    public function getAllProjects(): Collection
    {
        return Project::orderBy('period_from', 'desc')->get();
    }

    public function createProject(array $data): Project
    {
        $project = Project::create($data);
        Log::info('プロジェクトを登録しました。', ['id' => $project->id]);
        return $project;
    }

    public function updateProject(Project $project, array $data): Project
    {
        $project->update($data);
        Log::info('プロジェクトを更新しました。', ['id' => $project->id]);
        return $project->fresh();
    }

    public function deleteProject(Project $project): void
    {
        $id = $project->id;
        $project->delete();
        Log::info('プロジェクトを削除しました。', ['id' => $id]);
    }

    // ─── BlogSummary ──────────────────────────────────────────────

    public function getAllBlogSummaries(): Collection
    {
        return BlogSummary::orderBy('created_at', 'desc')->get();
    }

    public function createBlogSummary(array $data): BlogSummary
    {
        $blog = BlogSummary::create($data);
        Log::info('ブログ概要を登録しました。', ['id' => $blog->id]);
        return $blog;
    }

    public function updateBlogSummary(BlogSummary $blogSummary, array $data): BlogSummary
    {
        $blogSummary->update($data);
        Log::info('ブログ概要を更新しました。', ['id' => $blogSummary->id]);
        return $blogSummary->fresh();
    }

    public function deleteBlogSummary(BlogSummary $blogSummary): void
    {
        $id = $blogSummary->id;
        $blogSummary->delete();
        Log::info('ブログ概要を削除しました。', ['id' => $id]);
    }

    // ─── Contact ──────────────────────────────────────────────────

    public function getAllContacts(): Collection
    {
        return Contact::orderBy('type')->get();
    }

    public function createContact(array $data): Contact
    {
        $contact = Contact::create($data);
        Log::info('連絡先を登録しました。', ['id' => $contact->id]);
        return $contact;
    }

    public function updateContact(Contact $contact, array $data): Contact
    {
        $contact->update($data);
        Log::info('連絡先を更新しました。', ['id' => $contact->id]);
        return $contact->fresh();
    }

    public function deleteContact(Contact $contact): void
    {
        $id = $contact->id;
        $contact->delete();
        Log::info('連絡先を削除しました。', ['id' => $id]);
    }
}