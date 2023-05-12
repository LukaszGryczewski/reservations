<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable for Show.
     *
     * @var array
     */
    protected $fillable=['slug',
                         'title',
                         'description',
                         'poster_url',
                         'location_id',
                         'bookable',
                         'price'
                        ];

    /**
     * The table shows associated with the model.
     *
     * @var string
     */
    protected $table = 'shows';

    /**
     * Indicates if the model should be timestamped off.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get location for the show
     *
     */
    public function location(){
        return $this->belongsTo(Location::class);
    }

    /**
     * Function relation OneToMany revers with Representation
     *
     */
    public function representations(){
        return $this->hasMany(Representation::class);
    }

    /**
     * Get the performances (artists in a type of collaboration) for the show
     */
    public function artistTypes()
    {
        return $this->belongsToMany(ArtistType::class);
    }
}

