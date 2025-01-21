<div class="mt-7">
    <div class="flex justify-center">
        <ul class="pagination flex list-none gap-2">
            @if($currentPage > 1)
                <li>
                    <a href="javascript:void(0);" onclick="fetchPage({{ $currentPage - 1 }})"
                        class="py-2 px-4 bg-gray-300 text-black rounded">Previous</a>
                </li>
            @endif
            @for($i = 1; $i <= $totalPages; $i++)
                <li>
                    <a href="javascript:void(0);" onclick="fetchPage({{ $i }})"
                        class="py-2 px-4 {{ $currentPage == $i ? 'bg-gray-800 text-white' : 'bg-gray-200 text-black' }} rounded">{{ $i }}</a>
                </li>
            @endfor
            @if($currentPage < $totalPages)
                <li>
                    <a href="javascript:void(0);" onclick="fetchPage({{ $currentPage + 1 }})"
                        class="py-2 px-4 bg-gray-300 text-black rounded">Next</a>
                </li>
            @endif
        </ul>
    </div>
</div>
