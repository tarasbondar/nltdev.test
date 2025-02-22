<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserApiResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'contacts' => ContactDependencyApiResource::collection($this->contacts),
            'note' => ($this->note) ? $this->note->note : ''
        ];
    }
}
