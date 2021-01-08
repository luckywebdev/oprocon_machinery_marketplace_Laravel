<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteRequestsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_requests';

    /**
     * Run the migrations.
     * @table quote_requests
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->unsignedBigInteger('requester_id')->nullable()->default(null);
            $table->unsignedBigInteger('requestee_id')->nullable()->default(null);

            $table->index(["requestee_id"], 'fk_quoterequest_useraccount1_id_idx');

            $table->index(["project_id"], 'fk_quote_requests_job_idx');

            $table->index(["requester_id"], 'fk_quoterequest_useraccount_id_idx');
            $table->nullableTimestamps();


            $table->foreign('project_id', 'fk_quote_requests_job_idx')
                ->references('id')->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('requestee_id', 'fk_quoterequest_useraccount1_id_idx')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('requester_id', 'fk_quoterequest_useraccount_id_idx')
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
