<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProxyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'country' => $this->resource->country,
            'type' => $this->resource->type,
            'query' => $this->resource->query,
            'timing' => $this->resource->timing,
            'kind' => $this->resource->kind,
            'work' => $this->resource->work,
            'ip_port' => $this->resource->ip_port,
        ];
    }
}
