<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;

     /**
     * The attributes 'postal_code' and 'locality'
     * that are assignable.
     *
     * @var array
     */
    protected $fillable = ['postal_code','locality'];

    /**
     * The table 'localities' associated with the model.
     *
     * @var string
     */
    protected $table = 'localities';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;



}
