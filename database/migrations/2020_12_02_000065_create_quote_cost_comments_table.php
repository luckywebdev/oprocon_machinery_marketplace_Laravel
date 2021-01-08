<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteCostCommentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_cost_comments';

    /**
     * Run the migrations.
     * @table quote_cost_comments
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
            $table->unsignedBigInteger('quote_id')->nullable()->default(null);
            $table->unsignedBigInteger('quote_milestone_id')->nullable()->default(null);
            $table->unsignedBigInteger('quote_cost_id')->nullable()->default(null);

            $table->index(["user_id"], 'fk_quotecostcomments_useraccount_id_idx');

            $table->index(["quote_milestone_id"], 'fk_quote_cost_comments_2_idx');

            $table->index(["quote_cost_id"], 'fk_quote_cost_comments_3_idx');

            $table->index(["quote_id"], 'fk_quote_cost_comments_1_idx');
            $table->nullableTimestamps();


            $table->foreign('quote_id', 'fk_quote_cost_comments_1_idx')
                ->references('id')->on('quotes')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('quote_milestone_id', 'fk_quote_cost_comments_2_idx')
                ->references('id')->on('quote_milestones')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('quote_cost_id', 'fk_quote_cost_comments_3_idx')
                ->references('id')->on('quote_milestone_costs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_quotecostcomments_useraccount_id_idx')
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
