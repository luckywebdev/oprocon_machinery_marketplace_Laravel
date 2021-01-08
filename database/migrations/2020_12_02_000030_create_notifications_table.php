<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'notifications';

    /**
     * Run the migrations.
     * @table notifications
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('notification_type_id')->nullable()->default(null);
            $table->unsignedBigInteger('receiver_id')->nullable()->default(null);
            $table->text('message');
            $table->string('url', 128)->nullable()->default(null);
            $table->timestamp('time')->nullable()->default(null);
            $table->tinyInteger('notified')->default('0');

            $table->index(["notification_type_id"], 'fk_notifications_type_idx');

            $table->index(["receiver_id"], 'fk_notifications_receiver_idx');
            $table->nullableTimestamps();


            $table->foreign('notification_type_id', 'fk_notifications_type_idx')
                ->references('id')->on('notification_types')
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
