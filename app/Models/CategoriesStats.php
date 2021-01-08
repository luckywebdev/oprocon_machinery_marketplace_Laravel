<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesStats extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="categories_stats";
    protected $fillable = [
        'category_id',
        'group_id',
        'active_portfolios',
        'active_projects',
        'active_quotes',
        'created_at',
        'updated_at',
    ];
}
