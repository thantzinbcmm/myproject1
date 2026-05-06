// routes/api.php
<?php

use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\BlogSummaryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DesignSettingController;
use App\Http\Controllers\Api\TechStackController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('experience', ExperienceController::class)->except(['create', 'edit']);
    Route::apiResource('projects', ProjectController::class)->except(['create', 'edit']);
    Route::apiResource('blog-summary', BlogSummaryController::class)->except(['create', 'edit']);
    Route::apiResource('contact', ContactController::class)->except(['create', 'edit']);

    Route::get('design-settings', [DesignSettingController::class, 'index']);
    Route::post('design-settings', [DesignSettingController::class, 'store']);

    Route::get('tech-stack', [TechStackController::class, 'index']);
    Route::post('tech-stack', [TechStackController::class, 'store']);
});