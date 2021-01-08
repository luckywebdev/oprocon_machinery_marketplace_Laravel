<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBankAccountsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_bank_accounts';

    /**
     * Run the migrations.
     * @table user_bank_accounts
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('iban', 34)->nullable()->default(null);
            $table->string('bic', 11)->nullable()->default(null);
            $table->string('first_name', 40)->nullable()->default(null);
            $table->string('last_name', 40)->nullable()->default(null);
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->string('state', 64)->nullable()->default(null);
            $table->string('city', 64)->nullable()->default(null);
            $table->string('zip_code', 64)->nullable()->default(null);

            $table->index(["user_id"], 'fk_userbankacct_useraccount_id_idx');
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
