<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'packages';

    /**
     * Run the migrations.
     * @table packages
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('package_name')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->tinyInteger('is_active')->default('0');
            $table->integer('credits')->default('0');
            $table->integer('total_days')->default('0');
            $table->decimal('amount', 10, 2)->default('0.00');
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
