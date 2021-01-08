<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioStandardPropertiesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_standard_properties';

    /**
     * Run the migrations.
     * @table portfolio_standard_properties
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->string('unit', 20)->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->tinyInteger('main_item')->nullable()->default(null)->comment('is generic =1');
            $table->integer('sort_order')->nullable()->default(null);
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
