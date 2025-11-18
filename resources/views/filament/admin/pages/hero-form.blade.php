<x-filament-panels::page>
    <div class="max-w-4xl mx-auto">
        @if(!$isEditing)
            <!-- View Mode -->
            <x-filament::section>
                <x-slot name="heading">
                    Data Hero Section
                </x-slot>

                @if($heroSection)
                    <div class="space-y-6">
                        <!-- Judul -->
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                            <div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Judul</div>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $heroSection->judul }}
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                            <div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Deskripsi</div>
                            <div class="text-gray-900 dark:text-white">
                                {{ $heroSection->deskripsi }}
                            </div>
                        </div>

                        <!-- Gambar -->
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                            <div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Gambar</div>
                            @if($heroSection->gambar)
                                <img src="{{ asset('storage/' . $heroSection->gambar) }}" 
                                     alt="Hero Image" 
                                     class="max-w-md rounded-lg shadow-md"
                                     onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                            @else
                                <div class="text-gray-500 dark:text-gray-400">Tidak ada gambar</div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-500 dark:text-gray-400">Belum ada data hero section</div>
                    </div>
                @endif
            </x-filament::section>
        @else
            <!-- Edit Mode -->
            <x-filament::section>
                <x-slot name="heading">
                    Edit Hero Section
                </x-slot>

                <form wire:submit="save" class="space-y-6">
                    {{ $this->form }}
                </form>
            </x-filament::section>
        @endif
    </div>
</x-filament-panels::page>