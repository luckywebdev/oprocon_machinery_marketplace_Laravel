<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'rating_categories';

    /**
     * Run the migrations.
     * @table rating_categories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('role_id')->nullable()->default(null);
            $table->string('name', 50)->nullable()->default(null);
            $table->tinyInteger('min_value')->nullable()->default(null);
            $table->tinyInteger('max_value')->nullable()->default(null);

            $table->index(["role_id"], 'fk_rating_categories_role_idx');
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
