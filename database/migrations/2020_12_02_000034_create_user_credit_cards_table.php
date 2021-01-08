<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCreditCardsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_credit_cards';

    /**
     * Run the migrations.
     * @table user_credit_cards
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('first_name', 50)->nullable()->default(null);
            $table->string('last_name', 50)->nullable()->default(null);
            $table->string('type', 50)->nullable()->default(null);
            $table->char('expiration_date_month', 2)->nullable()->default(null);
            $table->char('expiration_date_year', 4)->nullable()->default(null);
            $table->string('account_number', 34)->nullable()->default(null);
            $table->string('security_number', 45)->nullable()->default(null);
            $table->tinyInteger('is_default')->default('0');

            $table->index(["user_id"], 'fk_user_cc_user_account_idx');
            $table->nullableTimestamps();


            $table->foreign('user_id', 'fk_user_cc_user_account_idx')
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
