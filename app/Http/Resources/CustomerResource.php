<?php
namespace App\Http\Resources;
use App\Concessionaire;
use App\District;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'birth_date' => $this->birth_date,
            'state' => $this->state,
            'concessionaire' => [
                'name' =>  $this->concessionaire->name,
                'id' => $this->concessionaire->id,
            ],

            'address' => [
                'nameDistrict' => $this->district->name,
                'districtId' => $this->district->id,
                'nameProvincy' => $this->district->provincy->name,
                'provincyId' => $this->district->provincy->id,
                'nameApartment' => $this->district->provincy->apartment->name,
                'apartmentId' => $this->district->provincy->apartment->id,
                'address' => $this->address,
            ]
           
        ];
    }
}
