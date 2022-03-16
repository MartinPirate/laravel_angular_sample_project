<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{


    protected $token;

    public function __construct( $jwt_token=null)
    {
        $this->token = $jwt_token;
    }


    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['roles', 'playlists'];

    public function transform(User $user): array
    {


        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'email_verified' => $user->email_verified_at != null,
            'access_token' => $this->token,
        ];


    }

}
