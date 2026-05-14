<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitCounter extends Model
{
    use SoftDeletes;

    protected $fillable = ['ruta', 'contador'];
}
