<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'invoices';

    /**
     * Run the migrations.
     * @table invoices
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable()->default(null);
            $table->unsignedBigInteger('milestone_id')->nullable()->default(null);
            $table->unsignedBigInteger('sender_id')->nullable()->default(null);
            $table->unsignedBigInteger('reciever_id');
            $table->decimal('amount', 10, 2)->default('0.00');
            $table->tinyInteger('vat_percent')->default('0');
            $table->tinyInteger('discount_percent')->default('0');
            $table->dateTime('billing_date')->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->string('number', 45)->nullable()->default(null);
            $table->tinyInteger('status_id')->default('1');

            $table->index(["milestone_id"], 'fk_invoice_milestone_idx');

            $table->index(["project_id"], 'fk_invoice_job_idx');

            $table->index(["reciever_id"], 'fk_invoice_reciever_idx');

            $table->index(["sender_id"], 'fk_invoice_sender_idx');
            $table->nullableTimestamps();


            $table->foreign('milestone_id', 'fk_invoice_milestone_idx')
                ->references('id')->on('milestones')
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
