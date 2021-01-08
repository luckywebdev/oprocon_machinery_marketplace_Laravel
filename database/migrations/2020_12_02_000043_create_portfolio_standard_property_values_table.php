<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioStandardPropertyValuesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_standard_property_values';

    /**
     * Run the migrations.
     * @table portfolio_standard_property_values
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_id')->nullable()->default(null);
            $table->unsignedBigInteger('portfolio_property_id')->nullable()->default(null);
            $table->string('value', 200)->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);

            $table->index(["portfolio_id"], 'fk_mcv_machinery_idx');

            $table->index(["portfolio_property_id"], 'fk_mcv_characteristic_idx');
            $table->nullableTimestamps();


            $table->foreign('portfolio_id', 'fk_mcv_machinery_idx')
                ->references('id')->on('portfolios')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('portfolio_property_id', 'fk_mcv_characteristic_idx')
                ->references('id')->on('portfolio_standard_properties')
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
