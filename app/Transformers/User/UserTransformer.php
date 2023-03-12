<?php

declare(strict_types=1);

namespace App\Transformers\User;

use App\Models;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param  Models\User  $user
     * @return array
     */
    public function transform(Models\User $user): array
    {
        $result = [
            'id' => $user->id,
            'name' => $user->name,
            'percent' => $user->percent,
            'qr' => $user->qr
        ];

        return $result;
    }
}
