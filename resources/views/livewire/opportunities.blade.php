<div>
    <!-- Items per page selection -->
    <div>
        <label for="perPage">Items per page:</label>
        <select wire:change="updatePerPage($event.target.value)" id="perPage">
            @foreach($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
    </div>

    <!-- Search input -->
    <div>
        <label for="search">Search:</label>
        <input type="text" id="search" wire:keyup.debounce.500ms="updateSearch($event.target.value)" placeholder="Search items..." autocomplete="off">
    </div>

    <!-- Sort buttons -->
    <div>
        <button wire:click="sortBy('name')">
            Sort by Name
            @if($sortField === 'name')
            @if($sortDirection === 'asc') ▲ @else ▼ @endif
            @endif
        </button>
    </div>

    <!-- Items list -->
    <div>
        @forelse($items as $item)
        <div>{{ $item->name }}</div>
        @empty
        <p>No items found.</p>
        @endforelse
    </div>

    <!-- Pagination links -->
    <div>
        {{ $items->links('pagination::tailwind') }}
    </div>
</div>