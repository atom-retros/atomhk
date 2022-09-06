<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('website_ip_whitelist')) {
            Schema::create('website_ip_whitelist', function (Blueprint $table) {
                $table->id();
                $table->string('ip_address');
                $table->string('asn')->nullable();
                $table->boolean('whitelist_asn')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('website_ip_whitelist');
    }
};