<div class="space-y-4">
    @if($donateurs->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">Tidak ada donatur yang terkait dengan kegiatan ini.</p>
        </div>
    @else
        <div class="text-sm text-gray-600 mb-4">
            Total: <strong>{{ $donateurs->count() }}</strong> donatur
        </div>
        
        <div class="space-y-2 max-h-96 overflow-y-auto">
            @foreach($donateurs as $donatur)
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-semibold text-sm">
                            {{ strtoupper(substr($donatur->nama, 0, 1)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">{{ $donatur->nama }}</p>
                        <p class="text-sm text-gray-500">{{ $donatur->email }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        @if($donatur->receive_email_notifications ?? true)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Nonaktif
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>