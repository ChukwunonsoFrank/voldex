<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class Users extends Component
{
    use WithPagination;

    #[Url(as: 'search', keep: true)]
    public string $query = '';

    public function getStatusIndicatorColor(string $status): string
    {
        return match ($status) {
            'active', 'off_hold' => 'bg-success-50 text-success-600',
            'inactive', 'on_hold' => 'bg-error-50 text-error-600',
            default => 'bg-gray-50 text-gray-600',
        };
    }

    public function deactivateUser(int $userId)
    {
        try {
            User::where('id', '=', $userId, 'and')->update([
                'account_status' => 'inactive',
            ]);

            session()->flash('success-message', 'Deactivation successful.');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function banUser(int $userId)
    {
        try {
            User::where('id', '=', $userId, 'and')->update([
                'is_banned' => true,
            ]);

            session()->flash('success-message', 'Ban successful.');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function unbanUser(int $userId)
    {
        try {
            User::where('id', '=', $userId, 'and')->update([
                'is_banned' => false,
            ]);

            session()->flash('success-message', 'Unban successful.');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function destroyUser(int $userId)
    {
        try {
            DB::transaction(function () use ($userId) {
                // Delete related withdrawal records
                Withdrawal::where('user_id', '=', $userId, 'and')->delete();

                // Delete the user account
                $user = User::findOrFail($userId);
                $user->delete($userId);
            });

            session()->flash('success-message', 'User deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function activateUser(int $userId)
    {
        try {
            User::where('id', '=', $userId, 'and')->update([
                'account_status' => 'active',
            ]);
            session()->flash('success-message', 'Activation successful.');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function search()
    {
        // Reset to first page when searching
        $this->resetPage();
    }

    public function updatedQuery()
    {
        // Reset to first page when query changes
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query()->where('is_admin', 0);

        if (! empty($this->query)) {
            $query->where('username', 'LIKE', '%'.$this->query.'%');
        }

        $users = $query->latest()->paginate(20);

        return view('livewire.admin.users', [
            'users' => $users,
        ]);
    }

    protected function prepareSearchTerm(string $term): string
    {
        $sanitized = preg_replace('/[+\-><*~"()@.]/', ' ', $term);
        $words = array_filter(explode(' ', trim($sanitized)), fn ($word) => strlen($word) > 3);

        $preparedWords = array_map(fn ($word) => '+'.$word.'*', $words);

        return implode(' ', $preparedWords);
    }
}
