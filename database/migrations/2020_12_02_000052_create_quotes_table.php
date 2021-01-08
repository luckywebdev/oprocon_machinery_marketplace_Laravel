<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quotes';

    /**
     * Run the migrations.
     * @table quotes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->string('name', 200)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->unsignedBigInteger('quote_status_id')->nullable()->default(null);
            $table->integer('loop')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->unsignedBigInteger('provider_id')->nullable()->default(null);
            $table->decimal('amount', 10, 2)->default('0.00');
            $table->tinyInteger('escrow_required')->default('0');
            $table->tinyInteger('platform_required')->default('0');
            $table->tinyInteger('notify_lower')->default('0');
            $table->dateTime('due_date')->nullable()->default(null);

            $table->index(["project_id"], 'fk_quotes_jobs_idx');

            $table->index(["quote_status_id"], 'fk_quotes_status_idx');

            $table->index(["provider_id"], 'fk_quotes_provider_idx');

            $table->index(["user_id"], 'fk_quotes_creator_idx');
            $table->nullableTimestamps();


            $table->foreign('project_id', 'fk_quotes_jobs_idx')
                ->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('quote_status_id', 'fk_quotes_status_idx')
                ->references('id')->on('quote_status')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_quotes_creator_idx')
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
