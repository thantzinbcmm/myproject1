// routes/web.php
<?php

use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\BlogSummaryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DesignSettingController;
use App\Http\Controllers\Admin\TechStackController;
use Illuminate\Support\Facades\Route;

// トップページ（認証後リダイレクト先）
Route::get('/', function () {
    return redirect()->route('admin.contents.index');
})->middleware('auth');

// 認証ルート（Breeze）
require __DIR__ . '/auth.php';

// 管理者ルートグループ
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // ダッシュボード
    Route::get('/dashboard', function () {
        return redirect()->route('admin.contents.index');
    })->name('dashboard');

    // 掲載コンテンツ管理（タブ付き一覧）
    Route::get('/contents', [ExperienceController::class, 'index'])->name('contents.index');

    // 経歴
    Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
    Route::put('/experience/{experience}', [ExperienceController::class, 'update'])->name('experience.update');
    Route::delete('/experience/{experience}', [ExperienceController::class, 'destroy'])->name('experience.destroy');

    // プロジェクト
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // ブログ概要
    Route::post('/blog-summary', [BlogSummaryController::class, 'store'])->name('blog-summary.store');
    Route::put('/blog-summary/{blogSummary}', [BlogSummaryController::class, 'update'])->name('blog-summary.update');
    Route::delete('/blog-summary/{blogSummary}', [BlogSummaryController::class, 'destroy'])->name('blog-summary.destroy');

    // 連絡先
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

    // デザイン設定
    Route::get('/design', [DesignSettingController::class, 'index'])->name('design.index');
    Route::put('/design', [DesignSettingController::class, 'update'])->name('design.update');

    // 技術スタック
    Route::get('/tech-stack', [TechStackController::class, 'index'])->name('techstack.index');
    Route::post('/tech-stack', [TechStackController::class, 'update'])->name('techstack.update');
});