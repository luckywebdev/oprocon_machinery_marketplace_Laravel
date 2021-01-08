<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'milestones';

    /**
     * Run the migrations.
     * @table milestones
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->string('name', 200)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->dateTime('start_date')->nullable()->default(null);
            $table->dateTime('due_date')->nullable()->default(null);
            $table->decimal('amount', 10, 2)->default('0.00');
            $table->float('vat_percentage')->default('0');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('completion')->default('0');
            $table->tinyInteger('payment')->default('0');

            $table->index(["project_id"], 'fk_milestone_job_idx');
            $table->nullableTimestamps();


            $table->foreign('project_id', 'fk_milestone_job_idx')
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
