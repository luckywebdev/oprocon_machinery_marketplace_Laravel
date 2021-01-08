<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'ratings';

    /**
     * Run the migrations.
     * @table ratings
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_company_account_id')->nullable()->default(null);
            $table->unsignedBigInteger('review_id')->nullable()->default(null);
            $table->unsignedBigInteger('rating_category_id')->nullable()->default(null);
            $table->tinyInteger('rating')->nullable()->default(null);

            $table->index(["rating_category_id"], 'fk_ratings_category_idx');

            $table->index(["user_company_account_id"], 'fk_ratings_user_idx');

            $table->index(["review_id"], 'fk_ratings_review_idx');
            $table->nullableTimestamps();


            $table->foreign('rating_category_id', 'fk_ratings_category_idx')
                ->references('id')->on('rating_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('review_id', 'fk_ratings_review_idx')
                ->references('id')->on('reviews')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_company_account_id', 'fk_ratings_user_idx')
                ->references('id')->on('users')
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
