<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationalProfile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizationalprofiles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['opId', 'opName'];

}
