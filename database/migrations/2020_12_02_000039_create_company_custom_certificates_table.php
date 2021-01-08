<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCustomCertificatesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'company_custom_certificates';

    /**
     * Run the migrations.
     * @table company_custom_certificates
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_account_id')->default('0');
            $table->string('certificate_party', 64)->nullable()->default(null);
            $table->string('certificate_number', 64)->nullable()->default(null);
            $table->string('certificate_file')->nullable()->default(null);
            $table->dateTime('expire_date')->nullable()->default(null);

            $table->index(["company_account_id"], 'fk_compcustcertificates_useraccount_id_idx');
            $table->nullableTimestamps();


            $table->foreign('company_account_id', 'fk_compcustcertificates_useraccount_id_idx')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
