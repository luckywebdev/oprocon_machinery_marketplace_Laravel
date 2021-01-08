<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesStatFrequencies extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="categories_stat_frequencies";
    protected $fillable = [
        'frequency',
        'created_at',
        'updated_at',
    ];
}
