<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="groups";
    protected $fillable = [
        'group_name',
        'description',
        'attachment_url',
        'attachment_name',
        'created_at',
        'updated_at',
    ];
}
