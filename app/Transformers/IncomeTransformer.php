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
            'id' => $income->id,
            'i_judul' => $income->i_judul,
            'i_description' => $income->i_description,
            'i_jumlah' => $income->i_jumlah,
            'date_in' => $income->created_at->diffForHumans()
        ];
    }
}
