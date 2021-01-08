<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerCategoriesStatFrequencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `categories_stat_frequencies_BEFORE_INSERT` BEFORE INSERT ON `categories_stat_frequencies` FOR EACH ROW
		BEGIN
		SET new.created_at = utc_timestamp();
		END');
		
		DB::unprepared('CREATE TRIGGER `categories_stat_frequencies_BEFORE_UPDATE` BEFORE UPDATE ON `categories_stat_frequencies` FOR EACH ROW
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
        DB::unprepared('DROP TRIGGER `categories_stat_frequencies_BEFORE_INSERT`');
		DB::unprepared('DROP TRIGGER `categories_stat_frequencies_BEFORE_UPDATE`');
    }
}
