<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteMilestoneCostsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_milestone_costs';

    /**
     * Run the migrations.
     * @table quote_milestone_costs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quote_id')->nullable()->default(null);
            $table->unsignedBigInteger('quote_milestone_id')->nullable()->default(null);
            $table->tinyInteger('cost_type')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->decimal('amount', 10, 2)->default('0.00');
            $table->decimal('price', 10, 2)->default('0.00');
            $table->string('unit', 20)->nullable()->default(null);
            $table->tinyInteger('vat')->default('0');

            $table->index(["cost_type"], 'fk_quote_milestone_cost_cost_idx');

            $table->index(["quote_id"], 'fk_quote_milestone_cost_quote_idx');

            $table->index(["quote_milestone_id"], 'fk_quote_milestone_cost_milestone_idx');
            $table->nullableTimestamps();


            $table->foreign('quote_milestone_id', 'fk_quote_milestone_cost_milestone_idx')
                ->references('id')->on('quote_milestones')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('quote_id', 'fk_quote_milestone_cost_quote_idx')
                ->references('id')->on('quotes')
                ->onDelete('no action')
                ->onUpdate('no action');
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
