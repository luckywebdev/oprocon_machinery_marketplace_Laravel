<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTypeCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_type_categories';

    /**
     * Run the migrations.
     * @table portfolio_type_categories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_type_id')->nullable()->default(null);
            $table->string('category_name')->nullable()->default(null);

            $table->index(["portfolio_type_id"], 'fk_typecategories_portfoliotype_idx');
            $table->nullableTimestamps();


            $table->foreign('portfolio_type_id', 'fk_typecategories_portfoliotype_idx')
                ->references('id')->on('portfolio_types')
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
