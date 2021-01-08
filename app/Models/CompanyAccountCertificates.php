<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccountCertificates extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="company_account_certificates";
    protected $fillable = [
        'company_account_id',
        'company_certificate_id',
        'photo',
        'created_at',
        'updated_at',
    ];
}
