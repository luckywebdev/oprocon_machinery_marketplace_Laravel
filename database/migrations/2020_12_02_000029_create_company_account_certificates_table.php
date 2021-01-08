<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAccountCertificatesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'company_account_certificates';

    /**
     * Run the migrations.
     * @table company_account_certificates
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_account_id')->nullable()->default(null);
            $table->unsignedBigInteger('company_certificate_id')->nullable()->default(null);
            $table->string('photo', 128)->nullable()->default(null);

            $table->index(["company_account_id"], 'fk_companycertificates_useraccount_id_idx');

            $table->index(["company_certificate_id"], 'fk_companycertificates_certificates_idx');
            $table->nullableTimestamps();


            $table->foreign('company_account_id', 'fk_companycertificates_useraccount_id_idx')
                ->references('id')->on('company_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('company_certificate_id', 'fk_companycertificates_certificates_idx')
                ->references('id')->on('company_certificates')
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
