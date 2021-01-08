<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCustomItemValuesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_custom_item_values';

    /**
     * Run the migrations.
     * @table portfolio_custom_item_values
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_id')->nullable()->default(null);
            $table->string('name', 200)->nullable()->default(null);
            $table->string('unit', 20)->nullable()->default(null);
            $table->string('value', 200)->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);

            $table->index(["portfolio_id"], 'fk_mci_machinery_idx');
            $table->nullableTimestamps();


            $table->foreign('portfolio_id', 'fk_mci_machinery_idx')
                ->references('id')->on('portfolios')
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
