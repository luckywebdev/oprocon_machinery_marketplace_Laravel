<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteAttachmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quote_attachments';

    /**
     * Run the migrations.
     * @table quote_attachments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quote_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->dateTime('expiry_date')->nullable()->default(null);

            $table->index(["quote_id"], 'fk_quote_attachments_quote_idx');
            $table->nullableTimestamps();


            $table->foreign('quote_id', 'fk_quote_attachments_quote_idx')
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
