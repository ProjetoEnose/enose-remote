<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $search = ''; // Armazena o termo de busca
    protected $queryString = ['search'];

    public function render()
    {
        // Filtra os usuários pelo nome, ignorando o case
        $filteredUsers = User::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])->get();

        return view('livewire.user-list', [
            'users' => $filteredUsers,
        ]);
    }
}
