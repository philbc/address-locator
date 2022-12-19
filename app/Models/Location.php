<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

/**
 *  Location Model.
 *
 *  Database Attributes:
 *  @property int $id
 *  @property string $address
 *  @property string $latitude
 *  @property string $longitude
 *  @property date $created_at
 *  @property date $updated_at
 */
class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static function getLocations(string $latitude, string $longitude, int $radius = 0)
    {
        return self::selectRaw(
            "id, address, latitude, longitude, ( 
                3959 * acos( 
                    cos( radians(  ?  ) ) *
                    cos( radians( latitude ) ) * 
                    cos( radians( longitude ) - radians(?) ) + 
                    sin( radians(  ?  ) ) *
                    sin( radians( latitude ) ) 
                )
           ) AS distance", [$latitude, $longitude, $latitude]
        )
        ->having("distance", "<", $radius)
        ->get();
    }
}
