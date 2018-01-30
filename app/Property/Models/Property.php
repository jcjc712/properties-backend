<?php

namespace App\Property\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
          "code",
          "lat",
          "lng",
          "administrative_area_level_1",
          "administrative_area_level_2",
          "administrative_area_level_3",
          "name",
          "country",
          "locality",
          "political",
          "postal_code",
          "route",
          "street_number",
        "created_at",
        "updated_at",
        "description"
    ];

    public function images()
    {
        return $this->hasMany('App\Property\Models\Image','property_id','id');
    }

    public function features(){
        return $this->hasMany('App\Property\Models\Feature','property_id','id');
    }
}
