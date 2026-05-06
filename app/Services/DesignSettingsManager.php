// app/Services/DesignSettingsManager.php
<?php

namespace App\Services;

use App\Models\DesignSetting;
use Illuminate\Support\Facades\Log;

class DesignSettingsManager
{
    private ?DesignSetting $setting = null;

    public function getSetting(): DesignSetting
    {
        if ($this->setting === null) {
            $this->setting = DesignSetting::firstOrCreate(
                [],
                [
                    'theme'        => 'simple',
                    'color_scheme' => 'blue',
                    'font_style'   => 'Roboto',
                ]
            );
        }
        return $this->setting;
    }

    public function setTheme(string $theme): self
    {
        $this->getSetting()->theme = $theme;
        return $this;
    }

    public function setColorScheme(string $colorScheme): self
    {
        $this->getSetting()->color_scheme = $colorScheme;
        return $this;
    }

    public function setFontStyle(string $fontStyle): self
    {
        $this->getSetting()->font_style = $fontStyle;
        return $this;
    }

    public function save(array $data): DesignSetting
    {
        $setting = $this->getSetting();
        $setting->update($data);
        $this->setting = $setting->fresh();
        Log::info('デザイン設定を更新しました。', $data);
        return $this->setting;
    }
}