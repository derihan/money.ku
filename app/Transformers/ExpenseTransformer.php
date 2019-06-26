<?php

namespace App\Transformers;

use App\Expense;
use League\Fractal\TransformerAbstract;

class ExpenseTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Expense $expense)
    {
        return [
            //
            'e_id' => $expense->e_id,
            'e_judul' => $expense->e_judul,
            'e_description' => $expense->e_jumlah,
            'date_out' => $expense->created_at->diffForHumans()
        ];
    }
}
