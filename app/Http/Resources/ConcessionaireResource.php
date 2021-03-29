<?php
namespace App\Http\Resources;

use App\Customer;
use App\District;
use Illuminate\Http\Resources\Json\JsonResource;

class ConcessionaireResource extends JsonResource
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
            'active' => $this->active,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'district' => $this->district_id,
            'customers' => CustomerResource::collection($this->customers)
        ];
    }
}
