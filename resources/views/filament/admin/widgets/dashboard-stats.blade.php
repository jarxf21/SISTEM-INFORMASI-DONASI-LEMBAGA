<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="p-6 bg-blue-500 text-white rounded-xl shadow w-full flex justify-between items-center">
        <div>
            <div class="text-sm uppercase opacity-80">Total Donatur</div>
            <div class="text-3xl font-bold">{{ \App\Models\Donatur::count() }}</div>
            <div class="text-xs opacity-70">Orang yang berdonasi</div>
        </div>
        <x-heroicon-o-user-group class="w-12 h-12 opacity-50" />
    </div>

    <div class="p-6 bg-red-500 text-white rounded-xl shadow w-full flex justify-between items-center">
        <div>
            <div class="text-sm uppercase opacity-80">Total Kegiatan</div>
            <div class="text-3xl font-bold">{{ \App\Models\Kegiatan::count() }}</div>
            <div class="text-xs opacity-70">Kegiatan terlaksana</div>
        </div>
        <x-heroicon-o-calendar class="w-12 h-12 opacity-50" />
    </div>
</div>
