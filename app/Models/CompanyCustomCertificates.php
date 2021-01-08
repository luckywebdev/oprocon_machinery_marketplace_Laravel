<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCustomCertificates extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="company_custom_certificates";
    protected $fillable = [
        'company_account_id',
        'certificate_party',
        'certificate_number',
        'certificate_file',
        'expire_date',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the custom certificates associated with the company.
     */
    public function CompanyAccount()
    {
        return $this->belongsTo('App\Models\CompanyAccounts', 'company_account_id');
    }
}
