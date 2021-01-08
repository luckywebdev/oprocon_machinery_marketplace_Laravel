<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerQuoteMilestoneComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `quote_milestone_comments_BEFORE_INSERT` BEFORE INSERT ON `quote_milestone_comments` FOR EACH ROW
		BEGIN
		SET new.created_at = utc_timestamp();
		END');
		
		DB::unprepared('CREATE TRIGGER `quote_milestone_comments_BEFORE_UPDATE` BEFORE UPDATE ON `quote_milestone_comments` FOR EACH ROW
		BEGIN
		SET new.updated_at = utc_timestamp();
		END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `quote_milestone_comments_BEFORE_INSERT`');
		DB::unprepared('DROP TRIGGER `quote_milestone_comments_BEFORE_UPDATE`');
    }
}
