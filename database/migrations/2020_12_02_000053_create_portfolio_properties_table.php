<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioPropertiesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_properties';

    /**
     * Run the migrations.
     * @table portfolio_properties
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_property_id')->nullable()->default(null);
            $table->unsignedBigInteger('portfolio_category_id')->nullable()->default(null);
            $table->unsignedBigInteger('portfolio_type_id')->nullable()->default(null);

            $table->index(["portfolio_type_id"], 'fk_portoflioproperties_portfoliotype_id_idx');

            $table->index(["portfolio_property_id"], 'fk_mcc_characteristics_idx');

            $table->index(["portfolio_category_id"], 'fk_mcc_categories_idx');
            $table->nullableTimestamps();


            $table->foreign('portfolio_property_id', 'fk_mcc_characteristics_idx')
                ->references('id')->on('portfolio_standard_properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('portfolio_category_id', 'fk_mcc_categories_idx')
                ->references('id')->on('portfolio_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('portfolio_type_id', 'fk_portoflioproperties_portfoliotype_id_idx')
                ->references('id')->on('portfolio_types')
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
