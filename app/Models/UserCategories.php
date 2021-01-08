<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategories extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="user_categories";
    protected $fillable = [
        'user_id',
        'category_id',
        'created_at',
        'updated_at',
    ];


}
