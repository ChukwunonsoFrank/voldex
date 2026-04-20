<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    protected $fillable = ['user_id', 'amount', 'payment_method', 'address', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
