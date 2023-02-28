<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        if ($this->resource == null){
            return null;
        }
        
        $customer = $this->resource;

        return [
            'id' => $customer['id'],
            'name' => $customer['name'],
            'cpf' => $customer['cpf'],
            'birthdate' => $customer['birthdate'],
            'phone_number' => $customer['phone_number'],
        ];
    }
}
