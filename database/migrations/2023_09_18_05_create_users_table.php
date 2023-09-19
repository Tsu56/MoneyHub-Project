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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('us_fname');
            $table->string('us_lname');
            $table->date('us_datebirth');
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')
                  ->references('id')
                  ->on('genders')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('career_id');
            $table->foreign('career_id')
                  ->references('id')
                  ->on('careers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->boolean('is_plus')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->boolean('payment_status')->nullable();
            $table->dateTime('payment_datetime');
            $table->string('us_email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
