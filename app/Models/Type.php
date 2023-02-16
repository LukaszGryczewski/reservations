<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable guarded (type).
     *
     * @var array
     */
    protected $fillable = ['type' ];

    /**
     * The table associated with the model types.
     *
     * @var string
     */
    protected $table = 'types';

    /**
     * Indicates if the model should be timestamped false.
     *
     * @var bool
     */
    protected $timelabs = 'false';

    /**
     * Relation ManyToMany
     *
     */
    public function artists(){
        return $this->belongsToMany(Artist::class);
    }
}
