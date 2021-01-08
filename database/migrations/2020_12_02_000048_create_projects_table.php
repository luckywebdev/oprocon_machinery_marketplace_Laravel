<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'projects';

    /**
     * Run the migrations.
     * @table projects
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('project_name')->nullable()->default(null);
            $table->unsignedBigInteger('project_status_id')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->unsignedBigInteger('project_type_detail_id')->nullable()->default(null);
            $table->dateTime('start_date')->nullable()->default(null);
            $table->integer('project_duration')->default('0');
            $table->dateTime('due_date')->nullable()->default(null);
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->string('state', 50)->nullable()->default(null);
            $table->string('city', 50)->nullable()->default(null);
            $table->string('milestone', 50)->nullable()->default(null);
            $table->integer('mile_notify')->nullable()->default(null);
            $table->text('manual_job')->nullable()->default(null);
            $table->unsignedInteger('budget_min')->nullable()->default('0');
            $table->unsignedInteger('budget_max')->nullable()->default('0');
            $table->tinyInteger('vat_percent')->default('0');
            $table->integer('is_feature')->nullable()->default(null);
            $table->integer('is_urgent')->nullable()->default(null);
            $table->integer('is_hide_bids')->nullable()->default('0');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->date('end_date')->nullable()->default(null);
            $table->unsignedBigInteger('employee_id')->nullable()->default(null);
            $table->string('checkstamp', 50)->nullable()->default(null);
            $table->enum('owner_rated', ['0', '1'])->nullable()->default(null);
            $table->enum('employee_rated', ['0', '1'])->nullable()->default(null);
            $table->enum('job_paid', ['0', '1'])->nullable()->default(null);
            $table->date('job_award_date')->nullable()->default(null);
            $table->integer('notification_status')->nullable()->default('0');
            $table->integer('is_private')->nullable()->default('0');
            $table->text('private_users')->nullable()->default(null);
            $table->text('contact')->nullable()->default(null);
            $table->string('salary', 15)->nullable()->default(null);
            $table->integer('flag')->nullable()->default(null);
            $table->string('salarytype', 100)->nullable()->default(null);
            $table->integer('escrow_due')->nullable()->default(null);
            $table->string('invite_suppliers', 124)->nullable()->default(null);
            $table->integer('team_member_id')->nullable()->default(null);
            $table->unsignedBigInteger('portfolio_id')->nullable()->default(null);
            $table->integer('open_days')->nullable()->default(null);
            $table->dateTime('bidding_due_date')->nullable()->default(null);
            $table->integer('hide_bids_reveal')->nullable()->default('0');

            $table->index(["project_status_id"], 'jobs_jobstatus_id_idx');

            $table->index(["employee_id"], 'fk_jobs_provider_idx');

            $table->index(["portfolio_id"], 'fk_jobs_portfolio_idx');

            $table->index(["user_id"], 'fk_jobs_creator_idx');

            $table->index(["project_type_detail_id"], 'fk_projects_projecttypedtl_id_idx');

            $table->index(["country_id"], 'fk_jobs_country_idx');
            $table->nullableTimestamps();


            $table->foreign('project_type_detail_id', 'fk_projects_projecttypedtl_id_idx')
                ->references('id')->on('project_type_details')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('project_status_id', 'jobs_jobstatus_id_idx')
                ->references('id')->on('project_status')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('portfolio_id', 'fk_jobs_portfolio_idx')
                ->references('id')->on('portfolios')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('country_id', 'fk_jobs_country_idx')
                ->references('id')->on('countries')
                ->onDelete('no action')
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
