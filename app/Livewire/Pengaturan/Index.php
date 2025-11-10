<?php

namespace App\Livewire\Pengaturan;

use App\Models\Setting;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    /**
     * Daftar pengaturan yang akan ditampilkan per bagian.
     *
     * @var array<int, array<string, mixed>>
     */
    public array $sections = [];

    /**
     * Nilai formulir yang dibinding ke komponen Livewire.
     *
     * @var array<string, mixed>
     */
    public array $form = [];

    /**
     * Menyimpan kunci pengaturan yang terakhir berhasil disimpan.
     */
    public ?string $lastSavedKey = null;

    public function mount(): void
    {
        $settings = Setting::query()
            ->orderBy('section')
            ->orderBy('sort')
            ->get();

        $this->sections = $settings
            ->groupBy('section')
            ->map(function ($group) {
                $first = $group->first();

                return [
                    'section' => $first->section,
                    'label' => $first->section_label ?? Str::headline($first->section),
                    'description' => data_get($first->metadata, 'section_description'),
                    'settings' => $group->map(function (Setting $setting) {
                        return [
                            'id' => $setting->id,
                            'key' => $setting->key,
                            'label' => $setting->label,
                            'type' => $setting->type,
                            'description' => $setting->description,
                            'metadata' => $setting->metadata ?? [],
                        ];
                    })->values()->all(),
                ];
            })
            ->values()
            ->all();

        foreach ($settings as $setting) {
            $this->form[$setting->key] = $setting->type === Setting::TYPE_BOOLEAN
                ? $setting->valueAsBool()
                : ($setting->value ?? '');
        }
    }

    public function updatedForm($value, $key): void
    {
        $this->persistSetting($key, $value);

        $this->lastSavedKey = $key;

        $this->dispatch('setting-saved', key: $key);
    }

    public function render()
    {
        return view('livewire.pengaturan.index');
    }

    protected function persistSetting(string $key, $value): void
    {
        $setting = Setting::query()->where('key', $key)->first();

        if (! $setting) {
            return;
        }

        if ($setting->type === Setting::TYPE_BOOLEAN) {
            $setting->value = $value ? '1' : '0';
        } else {
            $setting->value = is_string($value) ? trim($value) : $value;
        }

        $setting->save();

        $this->form[$key] = $setting->type === Setting::TYPE_BOOLEAN
            ? $setting->valueAsBool()
            : ($setting->value ?? '');
    }
}
