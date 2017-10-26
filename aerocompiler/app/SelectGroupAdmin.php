<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class SelectGroupAdmin extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'selectgroupadmins';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['userId'];

}
