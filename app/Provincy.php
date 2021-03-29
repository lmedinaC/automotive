<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provincies';

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
        'apartment_id',
    ];


    /**
     * Relation one to many Concessionaires
     *
     */
    public function apartment(){
        return $this->belongsTo('App\Apartment', 'apartment_id');
    }

    /**
     * Relation one to many Districts
     *
     */
    public function districts(){
        return $this->hasMany('App\District');
    }


}
