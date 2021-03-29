<?php
namespace App\Http\Resources;
use App\District;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvincyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'districts' => DistrictResource::collection($this->districts)
        ];
    }
}
