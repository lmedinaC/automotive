<?php

namespace App\Http\Controllers;

use App\Concessionaire;
use App\Http\Resources\ConcessionaireCollection;
use App\Http\Resources\ConcessionaireResource;
use Illuminate\Http\Request;

class ConcessionaireController extends Controller
{
    /**
     * All Concessionaires Getter
    */
    public function getAll(){
        $concessionaires = new ConcessionaireCollection( Concessionaire::all());
        return $concessionaires;
    }

    /**
     * All Concessionaires Getter with custom Data
    */
    public function getAllData(){
        $concessionaires = ConcessionaireResource::collection( Concessionaire::all() );
        return $concessionaires;
    }
}
