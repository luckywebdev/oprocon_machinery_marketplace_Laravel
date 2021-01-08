<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTypeDetailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'project_type_details';

    /**
     * Run the migrations.
     * @table project_type_details
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('type_name')->nullable()->default(null);
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null)->comment('Userid');
            $table->tinyInteger('to_be_revised')->nullable()->default(null)->comment('approved by admin');
            $table->integer('is_draft')->nullable()->default(null);
            $table->tinyInteger('is_active')->default('1');

            $table->index(["category_id"], 'fk_ptd_categories_1_idx');
            $table->nullableTimestamps();


            $table->foreign('category_id', 'fk_ptd_categories_1_idx')
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
