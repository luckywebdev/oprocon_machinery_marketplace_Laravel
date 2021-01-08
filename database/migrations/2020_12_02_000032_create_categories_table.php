<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'categories';

    /**
     * Run the migrations.
     * @table categories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('category_name')->nullable()->default(null);
            $table->string('category_name_encry')->nullable()->default(null);
            $table->unsignedBigInteger('group_id')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->longText('attachment_url')->nullable()->default(null);
            $table->string('attachment_name', 60)->nullable()->default(null);
            $table->string('page_title')->nullable()->default(null);
            $table->text('meta_keywords')->nullable()->default(null);
            $table->text('meta_description')->nullable()->default(null);
            $table->tinyInteger('is_active')->default('1');

            $table->index(["group_id"], 'fk_categories_1_idx');
            $table->nullableTimestamps();


            $table->foreign('group_id', 'fk_categories_1_idx')
                ->references('id')->on('groups')
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
