<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCasesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'project_cases';

    /**
     * Run the migrations.
     * @table project_cases
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('admin_id')->nullable()->default(null);
            $table->unsignedBigInteger('project_case_type_id')->nullable()->default(null);
            $table->unsignedBigInteger('project_case_reason_id')->nullable()->default(null);
            $table->string('comments')->nullable()->default(null);
            $table->string('private_comments')->nullable()->default(null);
            $table->unsignedBigInteger('project_review_type_id')->nullable()->default(null);
            $table->integer('payment')->nullable()->default(null);
            $table->unsignedBigInteger('project_case_status_id')->default('0');
            $table->tinyInteger('notification_status')->default('0');

            $table->index(["project_case_reason_id"], 'fk_job_cases_reason_idx');

            $table->index(["admin_id"], 'fk_job_cases_admin_idx');

            $table->index(["project_case_status_id"], 'fk_job_cases_status_idx');

            $table->index(["project_review_type_id"], 'fk_job_cases_review_idx');

            $table->index(["user_id"], 'fk_job_cases_user_idx');

            $table->index(["project_id"], 'fk_job_cases_job_idx');

            $table->index(["project_case_type_id"], 'jobcases_jobcasetype_id_idx');
            $table->nullableTimestamps();


            $table->foreign('project_case_reason_id', 'fk_job_cases_reason_idx')
                ->references('id')->on('project_case_reasons')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('project_case_status_id', 'fk_job_cases_status_idx')
                ->references('id')->on('project_case_status')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('project_case_type_id', 'jobcases_jobcasetype_id_idx')
                ->references('id')->on('project_case_types')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_job_cases_user_idx')
                ->references('id')->on('users')
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
