<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvincyResource;
use App\Provincy;
use Illuminate\Http\Request;

class ProvincyController extends Controller
{
    /**
     * All Provincies Getter
    */
    public function getAll(){
        $apartments = ProvincyResource::collection(Provincy::all());
        return $apartments;
    }
}
