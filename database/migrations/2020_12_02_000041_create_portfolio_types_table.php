<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTypesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_types';

    /**
     * Run the migrations.
     * @table portfolio_types
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('type_name')->nullable()->default(null);
            $table->unsignedBigInteger('portfolio_category_id')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->integer('is_draft')->nullable()->default(null);
            $table->integer('to_be_revised')->nullable()->default(null);
            $table->tinyInteger('is_active')->nullable()->default('1');

            $table->index(["portfolio_category_id"], 'fk_portfoliotype_portfoliocategory_idx');
            $table->nullableTimestamps();


            $table->foreign('portfolio_category_id', 'fk_portfoliotype_portfoliocategory_idx')
                ->references('id')->on('categories')
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
