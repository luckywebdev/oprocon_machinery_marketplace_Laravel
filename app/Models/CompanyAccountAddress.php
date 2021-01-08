<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccountAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="company_account_address";
    protected $fillable = [
        'company_account_id',
        'company_address',
        'country_id',
        'state',
        'city',
        'zip_code',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the address associated with the company.
     */
    public function CompanyAccount()
    {
        return $this->belongsTo('App\Models\CompanyAccounts', 'id', 'company_account_id');
    }
}
