<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_categories';

    /**
     * Run the migrations.
     * @table portfolio_categories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_id')->nullable()->default(null);
            $table->unsignedBigInteger('category_id')->nullable()->default(null);

            $table->index(["category_id"], 'fk_portfoliocategories_portfoliocategory_id_idx');

            $table->index(["portfolio_id"], 'fk_portfolio_id_idx');
            $table->nullableTimestamps();


            $table->foreign('portfolio_id', 'fk_portfolio_id_idx')
                ->references('id')->on('portfolios')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id', 'fk_portfoliocategories_portfoliocategory_id_idx')
                ->references('id')->on('categories')
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
