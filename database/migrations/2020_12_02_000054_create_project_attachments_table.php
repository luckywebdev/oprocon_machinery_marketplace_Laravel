<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAttachmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'project_attachments';

    /**
     * Run the migrations.
     * @table project_attachments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->dateTime('expiry_date')->nullable()->default(null);

            $table->index(["project_id"], 'fk_job_attachments_job_idx');
            $table->nullableTimestamps();


            $table->foreign('project_id', 'fk_job_attachments_job_idx')
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
