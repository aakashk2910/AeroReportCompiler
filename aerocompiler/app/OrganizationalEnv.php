<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationalEnv extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizationalenvs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['userId', 'reportId', 'opId', 'opSubId', 'opInnerId', 'f1', 'f2', 'f3'];

}
