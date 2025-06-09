<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{

    public $search = '';

    public function render()
    {
        $query = User::query();

        $query->whereHas('roles', function ($q) {
            $q->whereIn('name', ['user']);
        });

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->get();

        return view('livewire.user-management')->with([
            'users' => $users
        ]);
    }

    public function updateUser() {}

    public function deleteUser() {}
}
