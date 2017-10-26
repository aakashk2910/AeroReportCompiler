<?php
/**
 * Copyright (c) 2016
 */

/**
 * Created by PhpStorm.
 * User: Aakash Kamble
 * Date: 28-02-2016
 * Time: 23:47
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class attachRole extends Model
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