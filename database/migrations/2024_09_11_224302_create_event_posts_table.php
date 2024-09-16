<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location_name');
            $table->string('location_url');
            $table->string('event_image_url');
            $table->integer('entry_fee')->default(0);
            $table->unsignedTinyInteger('restriction_age_min')->nullable();
            $table->unsignedTinyInteger('restriction_age_max')->nullable();
            $table->boolean("accecciblity_disablity")->default(false);

            // Foreign key constraints
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_posts');
    }
};
