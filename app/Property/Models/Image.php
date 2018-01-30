<?php

namespace App\Property\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        "property_id",
        "name",
        "created_at",
        "updated_at"
    ];
}
