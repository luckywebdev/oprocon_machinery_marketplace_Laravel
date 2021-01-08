<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteMilestoneAttachmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_milestone_attachments';

    /**
     * Run the migrations.
     * @table quote_milestone_attachments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quote_milestone_id')->nullable()->default(null);
            $table->string('name', 50)->nullable()->default(null);
            $table->string('url', 50)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->dateTime('expiry_date')->nullable()->default(null);

            $table->index(["quote_milestone_id"], 'fk_quote_milestone_attachments_quote_milestone_idx');
            $table->nullableTimestamps();


            $table->foreign('quote_milestone_id', 'fk_quote_milestone_attachments_quote_milestone_idx')
                ->references('id')->on('quote_milestones')
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
