<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesStatsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'categories_stats';

    /**
     * Run the migrations.
     * @table categories_stats
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->unsignedBigInteger('group_id')->nullable()->default(null);
            $table->integer('active_portfolios')->nullable()->default('0');
            $table->integer('active_projects')->nullable()->default('0');
            $table->integer('active_quotes')->default('0');
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
