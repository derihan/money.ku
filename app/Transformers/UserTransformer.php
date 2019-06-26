<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            //
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'registered_at' => $user->created_at->diffForHumans()
        ];
    }
}
