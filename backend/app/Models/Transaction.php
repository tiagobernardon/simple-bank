<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'description',
        'type',
        'check',
        'status',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfUser(Builder $query, int $userId = null): void
    {
        if ($userId) {
            $query->where('user_id', $userId);
        }
    }

    public function scopeOfType(Builder $query, string $type = null): void
    {
        if ($type) {
            $query->where('type', $type);
        }
    }

    public function scopeOfStatus(Builder $query, string $status = null): void
    {
        if ($status) {
            $query->where('status', $status);
        }
    }
}
