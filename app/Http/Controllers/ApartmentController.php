<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Http\Resources\ApartmentResource;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * All Apartments Getter
    */
    public function getAll(){
        //$apartments = Apartment::all();
        $apartments = ApartmentResource::collection(Apartment::all());
        return $apartments;
    }
}
