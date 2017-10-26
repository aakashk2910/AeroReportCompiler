<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormInput extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forminputs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['userId', 'subCriteriaId', 'labelId', 'labelText', 'A', 'D', 'L', 'I'];

}
