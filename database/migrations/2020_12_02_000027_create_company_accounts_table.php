<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAccountsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'company_accounts';

    /**
     * Run the migrations.
     * @table company_accounts
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('company_name', 128)->nullable()->default(null);
            $table->text('company_description')->nullable()->default(null);
            $table->string('tax_id', 128)->nullable()->default(null);
            $table->tinyInteger('vat_percent');
            $table->string('logo', 64)->nullable()->default(null);
            $table->string('logo_sm', 64)->nullable()->default(null);
            $table->string('logo_lg', 64)->nullable()->default(null);
            $table->nullableTimestamps();
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
