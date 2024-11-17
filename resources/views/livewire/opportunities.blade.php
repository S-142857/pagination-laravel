<div class="border-8 border-solid border-[#f8f4f9] bg-[#ffffff] rounded-3xl p-7 w-[1024px]">
    <h1 class="text-2xl font-bold">Welcome to the Opportunities Page</h1>
    <div class="flex justify-between mt-4">
        <!-- Sort buttons -->
        <div>
            <button wire:click="sortBy('name')" class="pt-2.5 pb-2.5">
                Sort by Name
                @if($sortField === 'name')
                @if($sortDirection === 'asc') ▲ @else ▼ @endif
                @endif
            </button>
        </div>

        <!-- Search input -->
        <div>
            <label for="search">Search:</label>
            <input
                type="text"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 focus:border-blue-500"
                id="search"
                wire:keyup.debounce.500ms="updateSearch($event.target.value)"
                placeholder="Search items..." />
        </div>

        <!-- Items per page selection -->
        <div>
            <label for="perPage">Items per page:</label>
            <select wire:change="updatePerPage($event.target.value)" id="perPage" class="border border-gray-300 rounded-lg text-gray-900 focus:border-blue-500 p-2.5">
                @foreach($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
        </div>
    </div>



    <!-- Items list -->
    <div class="h-[500px] overflow-auto mt-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2">No</th>
                    <th class="border border-gray-300 p-2">Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $index => $item)
                <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="border border-gray-300 p-2">{{ $index + 1 + ($items->currentPage() - 1) * $items->perPage() }}</td>
                    <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="border border-gray-300 p-2 text-center">No items found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <!-- Pagination links -->
    <div>
        {{ $items->links() }}
    </div>
</div>