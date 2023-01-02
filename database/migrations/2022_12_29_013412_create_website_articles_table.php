<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (config('habbo.core.using_atom_cms') && !Schema::hasTable('website_articles')) {
            Schema::create('website_articles', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->string('slug')->unique();
                $table->string('title');
                $table->string('short_story');
                $table->longText('full_story');
                $table->string('image');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('website_articles');
    }
};