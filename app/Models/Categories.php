<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Carbon\Carbon;

class Categories extends Model
{
    protected $table="categories";
    protected $fillable = [
        'category_name',
        'category_name_encry',
        'group_id',
        'description',
        'attachment_url',
        'attachment_name',
        'page_title',
        'meta_keywords',
        'meta_description',
        'is_active',
        'created_at',
        'updated_at'
    ];

    /**
     * The users that belong to the categories.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_categories');
    }
}
