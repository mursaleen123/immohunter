<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    use HasFactory;

    protected $fillable = [
        'title', 'location', 'price', 'description', 'status','property_link','user_id'
    ];
}
