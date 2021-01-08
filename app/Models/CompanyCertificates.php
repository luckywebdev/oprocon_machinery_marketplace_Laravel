<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCertificates extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="company_certificates";
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the company associated with the company certificates.
     */
    public function CompanyAccount()
    {
        return $this->belongsToMany('App\Models\CompanyAccounts', 'company_account_certificates', 'company_certificate_id', 'company_account_id');
    }
}
