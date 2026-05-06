// app/Http/Controllers/Api/DesignSettingController.php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDesignSettingRequest;
use App\Services\DesignSettingsManager;
use Illuminate\Http\JsonResponse;

class DesignSettingController extends Controller
{
    public function __construct(
        private readonly DesignSettingsManager $designManager
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->designManager->getSetting(),
        ]);
    }

    public function store(StoreDesignSettingRequest $request): JsonResponse
    {
        $setting = $this->designManager->save($request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => $setting,
        ]);
    }
}