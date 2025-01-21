<div class="mt-7">
    <div class="flex justify-center">
        <ul id="pagination_done" class="pagination flex list-none gap-2">
            @if($currentPage_done > 1)
                <li>
                    <a href="javascript:void(0);" onclick="fetchPage({{ $currentPage_done - 1 }}, 'done')"
                        class="py-2 px-4 bg-gray-300 text-black rounded">Previous</a>
                </li>
            @endif
            @for($i = 1; $i <= $totalPages_done; $i++)
                <li>
                    <a href="javascript:void(0);" onclick="fetchPage({{ $i }}, 'done')"
                        class="py-2 px-4 {{ $currentPage_done == $i ? 'bg-gray-800 text-white' : 'bg-gray-200 text-black' }} rounded">{{ $i }}</a>
                </li>
            @endfor
            @if($currentPage_done < $totalPages_done)
                <li>
                    <a href="javascript:void(0);" onclick="fetchPage({{ $currentPage_done + 1 }}, 'done')"
                        class="py-2 px-4 bg-gray-300 text-black rounded">Next</a>
                </li>
            @endif
        </ul>
    </div>
</div>

