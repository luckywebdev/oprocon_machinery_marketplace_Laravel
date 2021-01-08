<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_logins';

    /**
     * Run the migrations.
     * @table user_logins
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('user_name', 128)->nullable()->default(null);
            $table->unsignedBigInteger('time')->nullable()->default(null);
            $table->tinyInteger('success')->default('0');
            $table->tinyInteger('failure_reason')->nullable()->default(null);
            $table->string('user_agent', 200)->nullable()->default(null);
            $table->string('ip', 50)->nullable()->default(null);

            $table->index(["failure_reason"], 'fk_user_logins_reason_idx');
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
