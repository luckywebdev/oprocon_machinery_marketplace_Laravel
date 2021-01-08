<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCaseMessagesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'project_case_messages';

    /**
     * Run the migrations.
     * @table project_case_messages
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_case_id')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('subject')->nullable()->default(null);
            $table->string('message')->nullable()->default(null);
            $table->unsignedBigInteger('project_case_msg_status_id')->default('0');
            $table->tinyInteger('admin_approved')->default('0');

            $table->index(["project_case_id"], 'fk_jobcasemsgs_jobcase_id_idx');

            $table->index(["project_case_msg_status_id"], 'fk_jobcase_jobcasemsgstatus_id_idx');

            $table->index(["user_id"], 'fk_job_case_messages_user_idx');
            $table->nullableTimestamps();


            $table->foreign('project_case_msg_status_id', 'fk_jobcase_jobcasemsgstatus_id_idx')
                ->references('id')->on('project_case_status')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('project_case_id', 'fk_jobcasemsgs_jobcase_id_idx')
                ->references('id')->on('project_cases')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_job_case_messages_user_idx')
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
