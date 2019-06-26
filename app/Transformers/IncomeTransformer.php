<?php

namespace App\Transformers;

use App\Income;
use League\Fractal\TransformerAbstract;

class IncomeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Income $income)
    {
        return [
            //
            'i_id' => $income->e_id,
            'i_judul' => $income->e_judul,
            'i_description' => $income->e_jumlah,
            'date_in' => $income->created_at->diffForHumans()
        ];
    }
}
