<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apartments';

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
        'active'
    ];

    /**
     * Relation one to many Provincies
     *
     */
    public function provincies(){
        return $this->hasMany('App\Provincy');
    }
}
