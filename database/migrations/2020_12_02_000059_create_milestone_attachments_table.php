<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestoneAttachmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'milestone_attachments';

    /**
     * Run the migrations.
     * @table milestone_attachments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('milestone_id')->nullable()->default(null);
            $table->string('name', 50)->nullable()->default(null);
            $table->string('url', 50)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->dateTime('expire_date')->nullable()->default(null);

            $table->index(["milestone_id"], 'fk_milestone_attachments_milestone_idx');
            $table->nullableTimestamps();


            $table->foreign('milestone_id', 'fk_milestone_attachments_milestone_idx')
                ->references('id')->on('milestones')
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
