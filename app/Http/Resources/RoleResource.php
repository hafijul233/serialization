<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        switch ($request->route()->getName()) {
            case 'users.index' :
                return [
                    'name' => $this->name ?? null
                ];

            case 'users.show' :
                return [
                    'name' => $this->name ?? null,
                    'link' => route('roles.show', $this->id)
                ];

            case 'roles.index' :
                return [
                    'id' => $this->id,
                    'name' => $this->name ?? null,
                    'link' => route('roles.show', $this->id),
                    'user_count' => $this->users()->exists() ? $this->users->count() : 0,
                    $this->mergeWhen($this->permissions()->isAdmin(), [
                        'permission_count' => '0',
                    ]),
                ];

            default :
                return parent::toArray($request);
        }
    }
}
