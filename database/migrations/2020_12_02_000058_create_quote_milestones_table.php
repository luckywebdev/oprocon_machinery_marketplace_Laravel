<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteMilestonesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_milestones';

    /**
     * Run the migrations.
     * @table quote_milestones
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quote_id')->nullable()->default(null);
            $table->string('name', 200)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->dateTime('due_date')->nullable()->default(null);
            $table->decimal('amount', 10, 2)->nullable()->default(null);
            $table->tinyInteger('is_added')->default('0')->comment('Milestone was added in previous loop');
            $table->tinyInteger('is_deleted')->default('0')->comment('Milestone was deleted in previous loop');
            $table->tinyInteger('is_added_cur')->default('0')->comment('Milestone was added in current loop');
            $table->tinyInteger('is_deleted_cur')->default('0')->comment('Milestone was deleted in current loop');
            $table->tinyInteger('escrow_required')->default('0');
            $table->tinyInteger('platform_required')->default('0');
            $table->tinyInteger('notify_lower')->default('0');

            $table->index(["quote_id"], 'fk_quote_milestone_quote_idx');
            $table->nullableTimestamps();


            $table->foreign('quote_id', 'fk_quote_milestone_quote_idx')
                ->references('id')->on('quotes')
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
