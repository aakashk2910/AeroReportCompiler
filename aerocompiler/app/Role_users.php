<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_users extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'user_id'];

}
