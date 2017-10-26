<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InnerOrganizationalProfile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'innerorganizationalprofiles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['opInnerId', 'opSubId', 'opInnerName'];

}
