<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'driver' => [
                'name' => $this->driver->name,
                'team_name' => $this->driver->team_name
            ],
            'sector_1' => floatval($this->sector_1),
            'sector_2' => floatval($this->sector_2),
            'sector_3' => floatval($this->sector_3),
            'lap_total' => $this->lap_total,
        ];
    }
}
