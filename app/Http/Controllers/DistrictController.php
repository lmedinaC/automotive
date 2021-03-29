<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Resources\DistrictResource;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * All Districts Getter
    */
    public function getAll(){
        $apartments = DistrictResource::collection(District::all());
        return $apartments;
    }
}
