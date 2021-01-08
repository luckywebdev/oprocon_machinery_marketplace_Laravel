<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolios';

    /**
     * Run the migrations.
     * @table portfolios
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('title', 100)->nullable()->default(null);
            $table->tinyInteger('payment_method')->nullable()->default(null)->comment('0- fixed payment 1- hourly payment');
            $table->tinyInteger('use_range')->nullable()->default(null)->comment('0- not selected 1- seleted');
            $table->decimal('price', 10, 2)->default('0.00');
            $table->integer('skill')->nullable()->default(null);
            $table->integer('header_img')->nullable()->default(null);
            $table->integer('thumbnail_img')->nullable()->default(null);
            $table->text('portfolio_description')->nullable()->default(null);
            $table->unsignedBigInteger('portfolio_type_id')->nullable()->default(null);
            $table->integer('team_member_id')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);

            $table->index(["user_id"], 'fk_portfolio_user');
            $table->nullableTimestamps();


            $table->foreign('user_id', 'fk_portfolio_user')
                ->references('id')->on('users')
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
