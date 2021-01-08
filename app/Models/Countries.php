<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="countries";
    protected $fillable = [
        'country_symbol',
        'country_name',
        'is_active',
        'created_at',
        'updated_at',
    ];
}
