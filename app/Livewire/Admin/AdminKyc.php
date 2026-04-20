<?php

namespace App\Livewire\Admin;

use App\Models\Kyc;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class AdminKyc extends Component
{
  use WithPagination;

  public function getStatusIndicatorColor(string $status)
  {
    if ($status === 'pending') {
      return 'bg-warning-50 text-warning-600';
    }

    if ($status === 'approved') {
      return 'bg-success-50 text-success-600';
    }

    if ($status === 'declined') {
      return 'bg-error-50 text-error-600';
    }
  }

  public function render()
  {
    $kycRequests = Kyc::with('user')->whereHas('user', function ($query) {
      $query->where('is_admin', 0);
    })->latest()->paginate(10);
    return view('livewire.admin.admin-kyc', [
      'kycRequests' => $kycRequests
    ]);
  }
}
