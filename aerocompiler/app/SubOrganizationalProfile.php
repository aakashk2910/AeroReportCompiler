<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubOrganizationalProfile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suborganizationalprofiles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['opSubId', 'opId', 'opSubName'];

}
