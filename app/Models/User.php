<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'refid',
        'login_name',
        'first_name',
        'last_name',
        'tax_id',
        'vat_percent',
        'role_id',
        'email',
        'role_id',
        'password',
        'language',
        'profile_desc',
        'user_status',
        'activation_key',
        'job_notify',
        'bid_notify',
        'message_notify',
        'rate',
        'logo',
        'logo_sm',
        'logo_lg',
        'photo',
        'last_activity',
        'user_rating',
        'num_reviews',
        'rating_hold',
        'tot_rating',
        'suspend_status',
        'ban_status',
        'team_owner',
        'online',
        'login_status',
        'login_token',
        'is_site_support',
        'mvp',
        'company_account_id',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the categories associated with the user.
     */
    public function Categories()
    {
        return $this->belongsToMany('App\Models\Categories', 'user_categories');
    }

    /**
     * Get the company associated with the user.
     */
    public function CompanyAccount() 
    {
        return $this->belongsTo('App\Models\CompanyAccounts', 'company_account_id');
    }

}
