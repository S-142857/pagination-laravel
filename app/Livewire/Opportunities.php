<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;

class Opportunities extends Component
{
    use WithPagination;

    public $perPage = 20; // Default items per page
    public $options = [20, 50, 100, 250]; // Items per page options
    public $search = ''; // Search term
    public $sortField = 'name'; // Default sort field
    public $sortDirection = 'asc'; // Default sort direction

    protected $queryString = ['perPage', 'search', 'sortField', 'sortDirection'];

    public function updatingPerPage()
    {
        $this->resetPage(); // Reset pagination when perPage changes
    }
    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search term changes
    }
    public function updatePerPage($value)
    {
        $this->perPage = $value;
        $this->resetPage();
    }
    public function updateSearch($value)
    {
        $this->search = $value;
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $items = Item::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.opportunities', [
            'items' => $items,
        ]);
    }
}
