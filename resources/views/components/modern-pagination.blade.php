{{-- resources/views/components/modern-pagination.blade.php --}}
@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between bg-white px-6 py-4 rounded-lg shadow-sm border border-gray-200">
        {{-- Results Info --}}


        {{-- Pagination Links --}}
        <div class="flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-300 bg-gray-100 rounded-lg cursor-not-allowed">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-800 hover:border-gray-400 transition-all duration-200">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Previous
                </a>
            @endif

            {{-- Page Numbers --}}
            <div class="hidden sm:flex items-center space-x-1">
                {{-- First Page --}}
                @if ($paginator->currentPage() > 3)
                    <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-orange-50 hover:text-orange-600 hover:border-orange-300 transition-all duration-200">
                        1
                    </a>
                    @if ($paginator->currentPage() > 4)
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500">
                            ...
                        </span>
                    @endif
                @endif

                {{-- Previous Pages --}}
                @for ($i = max(1, $paginator->currentPage() - 2); $i < $paginator->currentPage(); $i++)
                    <a href="{{ $paginator->url($i) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-orange-50 hover:text-orange-600 hover:border-orange-300 transition-all duration-200">
                        {{ $i }}
                    </a>
                @endfor

                {{-- Current Page --}}
                <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-orange-600 border border-orange-600 rounded-lg shadow-sm">
                    {{ $paginator->currentPage() }}
                </span>

                {{-- Next Pages --}}
                @for ($i = $paginator->currentPage() + 1; $i <= min($paginator->lastPage(), $paginator->currentPage() + 2); $i++)
                    <a href="{{ $paginator->url($i) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-orange-50 hover:text-orange-600 hover:border-orange-300 transition-all duration-200">
                        {{ $i }}
                    </a>
                @endfor

                {{-- Last Page --}}
                @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500">
                            ...
                        </span>
                    @endif
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-orange-50 hover:text-orange-600 hover:border-orange-300 transition-all duration-200">
                        {{ $paginator->lastPage() }}
                    </a>
                @endif
            </div>

            {{-- Mobile Page Info --}}
            <div class="sm:hidden">
                <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg">
                    {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
                </span>
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-800 hover:border-gray-400 transition-all duration-200">
                    Next
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            @else
                <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-300 bg-gray-100 rounded-lg cursor-not-allowed">
                    Next
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            @endif
        </div>
    </div>
@endif