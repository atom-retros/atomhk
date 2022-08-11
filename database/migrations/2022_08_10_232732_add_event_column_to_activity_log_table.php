<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventColumnToActivityLogTable extends Migration
{
    public function up()
    {
        if (config('habbo.core.run_default_migrations')) {
            Schema::connection(config('activitylog.database_connection'))->table(
                config('activitylog.table_name'),
                function (Blueprint $table) {
                    $table->string('event')->nullable()->after('subject_type');
                }
            );
        }
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->dropColumn('event');
        });
    }
}
