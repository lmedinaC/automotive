<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'districts';

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
        'provincy_id'
    ];


    /**
     * Relation one to many (inverse) Provincy
     *
     */
    public function provincy(){
        return $this->belongsTo('App\Provincy', 'provincy_id');
    }


    /**
     * Relation one to many Provincy
     *
     */
    public function concessionaires(){
        return $this->hasMany('App\Concessionaire');
    }

}
