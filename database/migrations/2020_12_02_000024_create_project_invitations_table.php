<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectInvitationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'project_invitations';

    /**
     * Run the migrations.
     * @table project_invitations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->unsignedBigInteger('sender_id')->nullable()->default(null);
            $table->unsignedBigInteger('receiver_id')->nullable()->default(null);
            $table->dateTime('invite_date')->nullable()->default(null);
            $table->tinyInteger('notification_status')->default('0');

            $table->index(["project_id"], 'fk_job_invitation_job_idx');

            $table->index(["sender_id"], 'fk_job_invitation_sender_idx');

            $table->index(["receiver_id"], 'fk_job_invitation_reciever_idx');
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
