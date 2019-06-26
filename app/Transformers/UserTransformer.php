<?php

namespace App\Transformers;

use App\User;
use App\Transformers\IncomeTransformer;
use App\Transformers\ExpenseTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    protected $availableIncludes = [
        'incomes',
        'expenses'
    ];
    
    public function transform(User $user)
    {
        return [
            //
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'registered_at' => $user->created_at->diffForHumans(),
            'income_count' => $user->incomes->count(),
            'expense_count' => $user->expenses->count()
        ];
    }

    public function includeIncomes(User $user)
    {
        # code...
        $income = $user->incomes; 
        return $this->collection($income, new IncomeTransformer);
    }
    
    public function includeExpenses(User $user)
    {
        $expense = $user->expenses;
        return $this->collection($expense, new ExpenseTransformer);
    }
    

}
