<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concessionaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'concessionaires';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes of the table
     *
     */
    protected $fillable = [ 
        'name',
        'active',
        'phone_number',
        'address',
        'district_id'
    ];

    /**
     * Relation one to many Customers
     *
     */
    public function customers(){
       
        return $this->hasMany('App\Customer','concessionaire_id');
    }

    /**
     * Relation one to many (inverse) District
     *
     */
    public function district(){
        return $this->belongsTo('App\District', 'district_id');

    }

}
