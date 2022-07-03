<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UsersIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatigSearch() {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%'. $this->search .'%')
        ->orWhere('email', 'like', '%'. $this->search .'%')
        ->orderBy('name')
        ->paginate();

        return view('livewire.admin.users-index', compact('users'));
    }
}
