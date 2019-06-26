<?php

namespace App\Policies;

use App\User;
use App\Income;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, Income $income)
    {
        # code...
        return $user->ownsIncome($income);
    }
}