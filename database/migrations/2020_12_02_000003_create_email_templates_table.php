<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'email_templates';

    /**
     * Run the migrations.
     * @table email_templates
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('type', 64)->nullable()->default(null);
            $table->text('title')->nullable()->default(null);
            $table->text('mail_subject')->nullable()->default(null);
            $table->text('mail_body')->nullable()->default(null);
            $table->tinyInteger('period_type')->default('0');
            $table->nullableTimestamps();
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
