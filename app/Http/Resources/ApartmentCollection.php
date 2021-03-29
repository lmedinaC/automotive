<?php
namespace App\Http\Resources;
use App\District;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApartmentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'provincies' => ProvincyResource::collection($this->provincies)
        ];
    }
}
