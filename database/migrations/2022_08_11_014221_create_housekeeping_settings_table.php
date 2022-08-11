<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('housekeeping_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->string('comment')->comment('Describe what the entry does')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('housekeeping_settings');
    }
};