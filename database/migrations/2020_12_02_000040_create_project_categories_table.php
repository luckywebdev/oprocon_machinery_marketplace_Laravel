<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'project_categories';

    /**
     * Run the migrations.
     * @table project_categories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->unsignedBigInteger('category_id')->nullable()->default(null);

            $table->index(["project_id"], 'fk_job_categories_job_idx');

            $table->index(["category_id"], 'fk_projectcategories_id_idx');
            $table->nullableTimestamps();


            $table->foreign('category_id', 'fk_projectcategories_id_idx')
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
