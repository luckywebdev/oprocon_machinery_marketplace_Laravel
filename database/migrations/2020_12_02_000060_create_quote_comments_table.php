<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteCommentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_comments';

    /**
     * Run the migrations.
     * @table quote_comments
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
            $table->string('comment_type')->nullable()->default(null);

            $table->index(["user_id"], 'fk_quotecomments_useraccount_id _idx');

            $table->index(["quote_id"], 'fk_quote_comments_1_idx');
            $table->nullableTimestamps();


            $table->foreign('quote_id', 'fk_quote_comments_1_idx')
                ->references('id')->on('quotes')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_quotecomments_useraccount_id _idx')
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
