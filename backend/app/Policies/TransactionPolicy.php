<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\UserTypeEnum;

class TransactionPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function viewAll(User $user): bool
    {
        return $user->type === UserTypeEnum::Admin; 
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->type === UserTypeEnum::Default;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->type === UserTypeEnum::Admin;
    }
}
