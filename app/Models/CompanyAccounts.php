<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Carbon\Carbon;

class CompanyAccounts extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="company_accounts";
    protected $fillable = [
        'company_name',
        'company_description',
        'tax_id',
        'vat_percent',
        'logo',
        'logo_sm',
        'logo_lg',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user associated with the company.
     */
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    /**
     * Get the address associated with the company.
     */
    public function CompanyAddress()
    {
        return $this->hasMany('App\Models\CompanyAccountAddress', 'company_account_id');
    }

    /**
     * Get the certificates associated with the company.
     */
    public function CompanyCertificate()
    {
        return $this->belongsToMany('App\Models\CompanyCertificates', 'company_account_certificates', 'company_account_id', 'company_certificate_id');
    }

    /**
     * Get the custom certificates associated with the company.
     */
    public function CompanyCustomCertificate()
    {
        return $this->hasMany('App\Models\CompanyCustomCertificates', 'company_account_id');
    }

}
