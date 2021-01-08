<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestoneCostDescriptionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'milestone_cost_descriptions';

    /**
     * Run the migrations.
     * @table milestone_cost_descriptions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('milestone_id')->nullable()->default(null);
            $table->tinyInteger('cost_type')->nullable()->default(null)->comment('1- labor 2- material 3- third party 4-travel cost ');
            $table->string('cost_description')->nullable()->default(null);
            $table->integer('qty_amount')->default('0');
            $table->float('cost_per_unit')->default('0');
            $table->string('unit', 50)->nullable()->default(null);
            $table->float('vat_percentage')->nullable()->default(null);
            $table->float('vat_amount')->default('0');
            $table->float('cost_total')->default('0');

            $table->index(["cost_type"], 'fk_mcd_type_idx');

            $table->index(["user_id"], 'fk_mcd_user_idx');

            $table->index(["milestone_id"], 'fk_mcd_milestone_idx');

            $table->index(["project_id"], 'fk_mcd_job_idx');
            $table->nullableTimestamps();


            $table->foreign('project_id', 'fk_mcd_job_idx')
                ->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('milestone_id', 'fk_mcd_milestone_idx')
                ->references('id')->on('milestones')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_mcd_user_idx')
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
