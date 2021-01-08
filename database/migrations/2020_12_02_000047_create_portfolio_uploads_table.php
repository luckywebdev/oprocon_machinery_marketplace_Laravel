<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioUploadsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'portfolio_uploads';

    /**
     * Run the migrations.
     * @table portfolio_uploads
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_id')->nullable()->default(null);
            $table->unsignedBigInteger('folder_id')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('ori_name')->nullable()->default(null);
            $table->dateTime('date')->nullable()->default(null);
            $table->string('ext', 12)->nullable()->default(null);
            $table->unsignedBigInteger('filesize')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);

            $table->index(["portfolio_id"], 'fk_portfolio_uploads_portfolio_idx');
            $table->nullableTimestamps();


            $table->foreign('portfolio_id', 'fk_portfolio_uploads_portfolio_idx')
                ->references('id')->on('portfolios')
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
