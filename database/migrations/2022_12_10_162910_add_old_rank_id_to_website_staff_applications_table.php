<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (config('habbo.core.using_atom_cms') && Schema::hasTable('website_staff_applications')) {
           Schema::table('website_staff_applications', function (Blueprint $table) {
               $table->integer('old_rank_id')->nullable()->after('rank_id');

               $table->foreign('old_rank_id')->references('id')->on('permissions')->cascadeOnDelete();
           });
       }
    }

    public function down()
    {
        Schema::table('website_staff_applications', function (Blueprint $table) {
            //
        });
    }
};