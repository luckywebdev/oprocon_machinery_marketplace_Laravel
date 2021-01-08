<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteMilestoneCommentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_milestone_comments';

    /**
     * Run the migrations.
     * @table quote_milestone_comments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('comment_text')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('quote_milestone_id')->nullable()->default(null);
            $table->string('comment_type')->nullable()->default(null);

            $table->index(["quote_milestone_id"], 'fk_quote_milestone_comments_2_idx');

            $table->index(["user_id"], 'fk_quotemilestone_useraccount_id_idx');
            $table->nullableTimestamps();


            $table->foreign('quote_milestone_id', 'fk_quote_milestone_comments_2_idx')
                ->references('id')->on('quote_milestones')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_quotemilestone_useraccount_id_idx')
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
