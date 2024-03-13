<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserTypeEnum;

class WalletPolicy
{
    public function viewBalance(User $user): bool
    {
        return $user->type === UserTypeEnum::Default->value;
    }
}
