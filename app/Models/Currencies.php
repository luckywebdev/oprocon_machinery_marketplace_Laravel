<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="currencies";
    protected $fillable = [
        'currency_name',
        'currency_type',
        'currency_symbol',
        'created_at',
        'updated_at',
    ];
}
