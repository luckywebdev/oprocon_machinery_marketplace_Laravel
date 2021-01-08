<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceStatusTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'invoice_status';

    /**
     * Run the migrations.
     * @table invoice_status
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->nullableTimestamps();

            $table->unique(["name"], 'name_UNIQUE');
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
