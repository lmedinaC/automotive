<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';


    /**
     * Attributes of the table
     *
     */
    protected $fillable = [ 
        'name',
        'last_name',
        'phone_number',
        'state',
        'birth_date',
        'address',
        'concessionaire_id',
        'district_id',
    ];


    /**
     * Relation one to many (inverse) Concessionaire
     *
     */
    public function concessionaire(){                  
        return $this->belongsTo('App\Concessionaire','concessionaire_id');
    }

     /**
     * Relation one to many (inverse) District
     *
     */
    public function district(){
        return $this->belongsTo('App\District', 'district_id');
    }

    
}
