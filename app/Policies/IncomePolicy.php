<?php

namespace App\Policies;

use App\User;
use App\Income;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncomePolicy
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

    public function delete(User $user, Income $income){
        return $user->ownsIncome($income);
    }

}
