<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'reviews';

    /**
     * Run the migrations.
     * @table reviews
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reviewer_id')->nullable()->default(null);
            $table->unsignedBigInteger('reviewee_id')->nullable()->default(null);
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->string('comments')->nullable()->default(null);

            $table->index(["project_id"], 'fk_reviews_job_idx');

            $table->index(["reviewer_id"], 'fk_reviews_reviewer_idx');

            $table->index(["reviewee_id"], 'fk_reviews_reviewee_idx');

            $table->unique(["reviewer_id", "project_id"], 'reviews_UNIQUE');
            $table->nullableTimestamps();


            $table->foreign('project_id', 'fk_reviews_job_idx')
                ->references('id')->on('projects')
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
