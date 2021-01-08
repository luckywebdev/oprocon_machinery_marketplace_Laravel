<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerCompanyAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `company_accounts_BEFORE_INSERT` BEFORE INSERT ON `company_accounts` FOR EACH ROW
		BEGIN
		SET new.created_at = utc_timestamp();
		END');
		
		DB::unprepared('CREATE TRIGGER `company_accounts_BEFORE_UPDATE` BEFORE UPDATE ON `company_accounts` FOR EACH ROW
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
        DB::unprepared('DROP TRIGGER `company_accounts_BEFORE_INSERT`');
		DB::unprepared('DROP TRIGGER `company_accounts_BEFORE_UPDATE`');
    }
}
