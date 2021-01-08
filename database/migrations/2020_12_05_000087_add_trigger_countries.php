<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `countries_BEFORE_INSERT` BEFORE INSERT ON `countries` FOR EACH ROW
		BEGIN
		SET new.created_at = utc_timestamp();
		END');
		
		DB::unprepared('CREATE TRIGGER `countries_BEFORE_UPDATE` BEFORE UPDATE ON `countries` FOR EACH ROW
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
        DB::unprepared('DROP TRIGGER `countries_BEFORE_INSERT`');
		DB::unprepared('DROP TRIGGER `countries_BEFORE_UPDATE`');
    }
}
