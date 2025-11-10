@php
    use App\Models\Setting;
@endphp

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (empty($this->sections))
            <div class="bg-white shadow rounded-lg p-10 text-center text-gray-500">
                <p class="text-lg font-semibold text-gray-700">Belum ada pengaturan yang tersedia.</p>
                <p class="mt-2 text-sm">Tambahkan data pengaturan melalui seeder atau panel admin untuk mulai
                    mengonfigurasikan aplikasi.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($this->sections as $section)
                    <div class="bg-white shadow rounded-xl p-6 flex flex-col gap-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-gray-800 font-bold text-xl">{{ $section['label'] }}</h3>
                                @if (!empty($section['description']))
                                    <p class="mt-1 text-sm text-gray-500">{{ $section['description'] }}</p>
                                @endif
                            </div>
                            <span
                                class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                Live Update
                            </span>
                        </div>

                        <div class="space-y-5">
                            @foreach ($section['settings'] as $setting)
                                <div class="border border-gray-100 rounded-lg p-4 shadow-sm">
                                    <div class="flex flex-col gap-4">
                                        <div class="flex flex-col gap-1">
                                            <span
                                                class="text-sm font-semibold text-gray-700">{{ $setting['label'] }}</span>
                                            @if (!empty($setting['description']))
                                                <span class="text-xs text-gray-500">{{ $setting['description'] }}</span>
                                            @endif
                                        </div>

                                        <div class="flex items-center justify-between gap-4 flex-wrap">
                                            @if ($setting['type'] === Setting::TYPE_BOOLEAN)
                                                <label
                                                    class="relative inline-flex items-center cursor-pointer select-none">
                                                    <input type="checkbox" class="sr-only peer"
                                                        wire:model.live="form.{{ $setting['key'] }}">
                                                    <div
                                                        class="w-12 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-navy-200 rounded-full peer peer-checked:bg-navy-600 transition-colors">
                                                    </div>
                                                    <span
                                                        class="ml-3 text-sm text-gray-600">{{ $this->form[$setting['key']] ?? false ? 'Aktif' : 'Nonaktif' }}</span>
                                                </label>
                                            @else
                                                <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full">
                                                    <input
                                                        type="{{ $setting['type'] === Setting::TYPE_URL ? 'url' : 'text' }}"
                                                        class="flex-1 border-gray-200 focus:border-navy-500 focus:ring-navy-500 rounded-md shadow-sm"
                                                        placeholder="{{ data_get($setting, 'metadata.placeholder') }}"
                                                        wire:model.live.debounce.600ms="form.{{ $setting['key'] }}">
                                                    @if (!empty($this->form[$setting['key']] ?? null))
                                                        <a href="{{ $this->form[$setting['key']] }}" target="_blank"
                                                            class="text-sm text-navy-700 hover:text-navy-900 font-medium">
                                                            Buka
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex items-center justify-between text-xs text-gray-400">
                                            <div class="flex items-center gap-2">
                                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                                <span>Perubahan tersimpan otomatis</span>
                                            </div>
                                            @if ($lastSavedKey === $setting['key'])
                                                <span class="text-emerald-600 font-semibold">Tersimpan ✓</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
