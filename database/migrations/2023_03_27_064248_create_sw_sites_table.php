<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sw_sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_url');
            $table->string('site_name');
            $table->string('site_company');
            $table->string('site_manager');
            $table->string('site_director');
            $table->string('site_phone');
            $table->string('site_address');
            $table->string('site_description');
            $table->string('site_logo');
            $table->string('site_email');
            $table->string('site_email_domain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sw_sites');
    }
};
