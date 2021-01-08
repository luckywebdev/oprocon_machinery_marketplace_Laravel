<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('refid', 128)->default('0');
            $table->string('login_name', 128)->nullable()->default(null);
            $table->string('first_name', 128)->nullable()->default(null);
            $table->string('last_name', 128)->nullable()->default(null);
            $table->string('tax_id', 128)->nullable()->default(null);
            $table->unsignedTinyInteger('vat_percent')->default('0');
            $table->integer('role_id')->default('0');
            $table->string('password', 128)->nullable()->default(null);
            $table->string('email', 128)->nullable()->default(null);
            $table->string('language', 250)->nullable()->default(null);
            $table->text('profile_desc')->nullable()->default(null);
            $table->tinyInteger('user_status')->default('0');
            $table->string('activation_key', 32)->nullable()->default(null);
            $table->tinyInteger('job_notify')->nullable()->default(null);
            $table->tinyInteger('bid_notify')->nullable()->default(null);
            $table->tinyInteger('message_notify')->nullable()->default(null);
            $table->smallInteger('rate')->nullable()->default(null);
            $table->string('logo', 64)->nullable()->default(null);
            $table->string('logo_sm', 64)->nullable()->default(null);
            $table->string('logo_lg', 64)->nullable()->default(null);
            $table->string('photo', 64)->nullable()->default(null);
            $table->integer('last_activity')->nullable()->default(null);
            $table->float('user_rating')->default('0');
            $table->integer('num_reviews')->nullable()->default(null);
            $table->integer('rating_hold')->nullable()->default(null);
            $table->integer('tot_rating')->nullable()->default(null);
            $table->enum('suspend_status', ['0', '1'])->default('0');
            $table->enum('ban_status', ['0', '1'])->default('0');
            $table->integer('team_owner')->nullable()->default(null);
            $table->enum('online', ['1', '0'])->default('1');
            $table->enum('login_status', ['1', '0'])->default('0');
            $table->unsignedBigInteger('currency_id')->nullable()->default(null);
            $table->string('login_series', 128)->nullable()->default(null);
            $table->string('login_token', 128)->nullable()->default(null);
            $table->tinyInteger('is_site_support')->default('0');
            $table->string('mvp', 20)->default('new');
            $table->unsignedBigInteger('company_account_id')->nullable()->default(null);

            $table->index(["company_account_id"], 'fk_useraccount_companyaccount_id_idx');

            $table->index(["currency_id"], 'fk_useraccount_currency_id_idx');

            $table->index(["login_name"], 'login_name_idx');

            $table->index(["password"], 'password_idx');

            $table->index(["login_name", "password"], 'login_name_password_idx');

            $table->index(["role_id"], 'fk_users_2');
            $table->nullableTimestamps();


            $table->foreign('company_account_id', 'fk_useraccount_companyaccount_id_idx')
                ->references('id')->on('company_accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('currency_id', 'fk_useraccount_currency_id_idx')
                ->references('id')->on('currencies')
                ->onDelete('no action')
                ->onUpdate('no action');
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
