<?php

namespace App\Policies;

use App\User;
use App\Expense;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user,Expense $expense)
    {
        return $user->ownsExpense($expense);
    }

    public function delete(User $user,Expense $expense)
    {
        return $user->ownsExpense($expense);
    }

}
