<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (config('habbo.core.using_atom_cms') && Schema::hasTable('website_staff_applications')) {
            Schema::create('website_staff_application_statuses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('application_id');
                $table->integer('user_id');
                $table->integer('staff_id');
                $table->boolean('accepted')->default(false);
                $table->timestamps();

                $table->foreign('application_id')->references('id')->on('website_staff_applications')->cascadeOnDelete();
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->foreign('staff_id')->references('id')->on('users')->cascadeOnDelete();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('website_staff_application_statuses');
    }
};