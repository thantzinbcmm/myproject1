// app/Http/Controllers/Admin/DesignSettingController.php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDesignSettingRequest;
use App\Models\DesignSetting;
use App\Services\DesignSettingsManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DesignSettingController extends Controller
{
    public function __construct(
        private readonly DesignSettingsManager $designManager
    ) {}

    public function index(): View
    {
        $setting = $this->designManager->getSetting();

        return view('admin.design.index', [
            'setting'      => $setting,
            'themes'       => DesignSetting::THEMES,
            'colorSchemes' => DesignSetting::COLOR_SCHEMES,
            'fontStyles'   => DesignSetting::FONT_STYLES,
        ]);
    }

    public function update(StoreDesignSettingRequest $request): RedirectResponse
    {
        $this->designManager->save($request->validated());
        return redirect()
            ->route('admin.design.index')
            ->with('success', 'デザイン設定を更新しました。');
    }
}