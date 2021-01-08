<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="ratings";
    protected $fillable = [
        'user_company_account_id',
        'review_id',
        'rating_category_id',
        'rating',
        'created_at',
        'updated_at',
    ];
}
