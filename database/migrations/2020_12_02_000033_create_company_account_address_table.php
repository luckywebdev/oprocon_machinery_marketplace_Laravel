<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAccountAddressTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'company_account_address';

    /**
     * Run the migrations.
     * @table company_account_address
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_account_id');
            $table->string('company_address')->nullable()->default(null);
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->string('state', 64)->nullable()->default(null);
            $table->string('city', 64)->nullable()->default(null);
            $table->string('zip_code', 64)->nullable()->default(null);

            $table->index(["country_id"], 'fk_companyaddress_countries_id_idx');

            $table->index(["company_account_id"], 'fk_companyaddress_companyaccount_id_idx');
            $table->nullableTimestamps();


            $table->foreign('company_account_id', 'fk_companyaddress_companyaccount_id_idx')
                ->references('id')->on('company_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('country_id', 'fk_companyaddress_countries_id_idx')
                ->references('id')->on('countries')
                ->onDelete('no action')
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
