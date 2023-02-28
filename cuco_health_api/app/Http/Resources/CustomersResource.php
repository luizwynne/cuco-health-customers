<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\CustomerResource;

class CustomersResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return $this->resource->map(function ($customer) {
            return (New CustomerResource($customer))->resolve();
        });
    }
}
