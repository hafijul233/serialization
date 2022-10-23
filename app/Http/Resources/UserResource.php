<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use JsonSerializable;

class UserResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'data';

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null,
            'verified' => !is_null($this->email_verified_at),
            'joined_at' => $this->created_at->format('r'),
            'photo' => asset('public/favicon.ico'),
            'roles' => $this->when($this->roles()->exists(), RoleResource::collection($this->roles), [])
        ];

    }

    /**
     * Get any additional data that should be returned with the resource array.
     *
     * @param Request $request
     * @return array
     */
    public function with($request)
    {
        return $this->with;
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->header('Server', 'Apache/2.24', true)
            ->header('Server', 'gws')
            ->header('Powered By', 'Django')
            ->header('x-azure-ref', '0MYlVYwAAAAAhYVwQt6bPQKFFVwQsQL80U0lOMzBFREdFMDIxNABlMWRmMDcwYS1hZTQ0LTRjMGItYTU0Yi1jNDkzODA0ZTRkOWY=')
            ->header('X-Powered-by', 'Express', true)
            ->header('x-fastly-request-id', '37f118464aab362426d143b511a575e82e3bd6b1')
            ->header('akamai-grn','0.444a3917.1666550693.1176f8ee')
            ->header('x-akamai-transformed', '9 - 0 pmb=mTOE,2mRUM,3')

        ;
    }
}
