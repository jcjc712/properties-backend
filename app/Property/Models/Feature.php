<?php

namespace App\Property\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        "property_id",
        "name",
        "description",
        "created_at",
        "updated_at"
    ];
}
