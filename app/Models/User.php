<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'username',
    'email',
    'password',
    'unhashed_password',
    'mobile_number',
    'balance',
    'tasks_completed',
    'task_pole',
    'daily_commission',
    'total_commission',
    'processing_amount',
    'withdrawal_password',
    'withdrawal_address',
    'withdrawal_address_type',
    'credit_score',
    'membership_level',
    'is_admin',
    'referral_code',
    'referred_by',
    'account_status',
    'lien_amount',
    'lien_status',
    'timezone',
    'last_reset_at',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'last_reset_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  /**
   * Get the user's initials
   */
  public function initials(): string
  {
    return Str::of($this->name)
      ->explode(' ')
      ->map(fn(string $name) => Str::of($name)->substr(0, 1))
      ->implode('');
  }

  public function isAdmin(): bool
  {
    return true;
  }

  public function tasks(): HasMany
  {
    return $this->hasMany(CompletedTask::class);
  }

  public function alerts(): HasMany
  {
    return $this->hasMany(Alert::class);
  }

  public function scopeSearch(Builder $query, string $term): Builder
  {
    return $query->where('username', 'LIKE', '%' . $term . '%');
  }
}
